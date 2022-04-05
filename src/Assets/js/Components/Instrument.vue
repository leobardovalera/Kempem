<template>
    <div id="instrument" class="container">
        <div class="instrument-screen" :class="{'d-block': index == acscreen,'d-none':index != acscreen}" v-for="(screen, index) in screens" :key="index">
            <div>
                <h3 class="section-title m-0">{{screen.name}}</h3>
                <div class="section-questions container">
                    <div class="section-description" v-html="screen.description"></div>
                    <question :ref="`question${q}`" class="col question" v-for="(q,p) in screen.questions" :key="p" @answer="setanswer" :version="version" :language="instrument.language" :data="question(q)"></question>
                </div> 
            </div>
        </div>
        <div class="section-controls" v-if="screens.length - 1 > acscreen">
            <div class="row">
                <div class="col d-none d-md-block">
                </div>
                <div class="col-12 col-md-6 text-center">
                    <div class="progress">
                        <div class="progress-bar bg-success text-black" role="progressbar" :style="`width: ${progress}%`" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">{{Math.ceil(progress)}}%</div>
                    </div>
                </div>
                <div class="col text-right">
                    <button v-if="actualscreen && !actualscreen.autoadvance" class="btn btn-primary" @click="nextscreen()">{{instrument.language=='EN'?'Continue':'Continuar'}} <i class="fas fa-fw fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <key v-on:keyup="keyboardEvent"></key>
    </div>
</template>

<script>
    import Question from "./Question.vue";
    import Key from "./Key.vue";

    export default {
        name: "instrument",
        components: { Question,Key },
        props: ['instrument','questions','version','evaluation'],
        
        data() {
            return {
                options: this.instrument.options && this.instrument.options != "null" ?this.instrument.options:{
                    sections:[]
                },
                acscreen:0,
                actualanswer: null,
                answers:[],
                respondidas: 0,
                screens:[],
                totalscreens: 0,
            }
        },
        mounted(){
            this.answers = this.evaluation && this.evaluation.answers?this.evaluation.answers:[];
            this.respondidas = this.answers.length;

            //validación de patrón repetitivo
            if(this.last5repeatedAnswers){
                document.location.href = "/evaluations/finalizado/"+this.evaluation.id;
                return;
            }

            let screens = [];
            for(let i in this.options.sections){
                let answered = false;
                if(this.options.sections[i].unico == undefined){
                    for(let j in this.options.sections[i].questions){
                        answered = answered || (this.answers && this.answers.filter((element) => element.question == this.options.sections[i].questions[j]).length > 0);
                    }
                    if(!answered){
                        screens.push({
                            name: this.options.sections[i].name,
                            description: this.options.sections[i].description,
                            questions: this.options.sections[i].questions,
                        });
                    }
                }else{
                    if(this.options.sections[i].aleatorio){
                        this.options.sections[i].questions = this.shuffle(this.options.sections[i].questions);
                    }
                    for(let j in this.options.sections[i].questions){
                        answered = this.answers && this.answers.filter((element) => element.question == this.options.sections[i].questions[j]).length > 0;
                        if(!answered){
                            screens.push({
                                name: this.options.sections[i].name,
                                description: this.options.sections[i].description,
                                questions: [
                                    this.options.sections[i].questions[j]
                                ],
                                autoadvance: true,
                            });
                        }
                    }
                }
            }
            this.screens = screens;
            this.totalscreens = this.screens.length + this.respondidas;
        },

        computed: {
            progress(){
                return (this.respondidas + 1) / this.totalscreens * 100;
            },
            actualscreen(){
                return this.screens[this.acscreen];
            },
            last5repeatedAnswers(){
                let answ = this.answers
                        .filter(a => a.type == '17')
                        .map(a => a.answer);
                answ = answ.slice(Math.max(answ.length - 15, 0));
                return answ.length >= 15 
                        && answ.every( v => v === answ[answ.length - 1] );
            },
            actualquestion(){
                return this.screens[this.acscreen].questions[0];
            },
        },

        methods: {
            question(id){
                let element = this.questions.filter((el) => el.identifier == id )[0];
                return element;
            },
            sendAnswers(){
                if(this.evaluation){
                    this.$axios
                        .post("/evaluations/answer", { 
                            evaluation: this.evaluation.id,
                            answers: this.answers
                        })
                        .then(() => {
                            this.nextscreen();
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }else{
                    this.nextscreen();
                }
            },
            setanswer(e){
                this.actualanswer = {
                    question: e.id,
                    answer: e.value,
                    type: e.type,
                    date: new Date(),
                    version: this.version 
                };

                for(let i in this.answers){
                    if(this.answers[i].question == e.id){
                        this.answers.splice(i,1);
                    }
                }
                this.answers.push(this.actualanswer);

                if(this.actualscreen.autoadvance){
                    this.sendAnswers();
                }
            },
            nextscreen(){
                if(this.last5repeatedAnswers){
                    document.location.href = "/evaluations/finalizado/"+this.evaluation.id;
                    return;
                }
                let invalids = document.querySelectorAll('.is-invalid');
                for(let i in invalids){
                    if(invalids[i].classList){
                        invalids[i].classList.remove("is-invalid");
                    }
                }
                let els = document.querySelectorAll(".instrument-screen.d-block .required");
                let valid = true;
                if(els.length > 0){
                    els.forEach(function(el) {
                        let elvalid = true;
                        let type = el.dataset.type;
                        switch(type){
                            case 'checkbox':
                                elvalid = el.checked;
                                break;
                            case 'radio':
                                let selc = false;
                                let inputs = el.querySelectorAll('input[type=radio]');
                                for(let i in inputs){
                                    selc = selc || inputs[i].checked;
                                }
                                elvalid = selc;
                                break;
                            default:
                                elvalid = (el.value != '');
                        }
                        valid = valid && elvalid;
                        if(!elvalid){
                            el.classList.add("is-invalid");
                            let inputs = el.querySelectorAll('input[type=radio], label');
                            for(let i in inputs){
                                if(inputs[i].classList){
                                    inputs[i].classList.add("is-invalid");
                                }
                            }
                        }
                    });
                    if(valid && this.evaluation){
                        this.$axios
                            .post("/evaluations/answer", { 
                                evaluation: this.evaluation.id,
                                answers: this.answers,
                                date: new Date(),
                                version: this.version 
                            });
                    }else{
                        document.querySelector('.instrument-screen.d-block .section-questions .is-invalid').scrollIntoView({behavior: "smooth"});
                    }
                }
                if(valid){
                    this.acscreen++;
                    this.respondidas++;
                    if(this.screens.length == this.acscreen+1){
                        this.$axios.post("/evaluations/process/"+this.evaluation.id);
                    }
                }
            },
            keyboardEvent (e) {
                if(this.screens[this.acscreen].questions && (e.key == "1" || e.key == "2" || e.key == "3" || e.key == "4" || e.key == "5" || e.key == "6" || e.key == "7")){
                    this.$refs[`question${this.actualquestion}`][0].value = e.key;
                }
            },
            shuffle(array) {
                var currentIndex = array.length, temporaryValue, randomIndex;
                // While there remain elements to shuffle...
                for (var i = array.length - 1; i > 0; i--) {
                    var j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
                return array;
            },
        }
    }
</script>

<style>
    .text17{
        min-height: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>