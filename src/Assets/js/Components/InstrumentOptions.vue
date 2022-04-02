<template>
    <div id="instrument-options" class="mb-4">
        <div class="row">
            <div class="col">
                <div id="accordion">
                    <div class="card mb-4" v-for="(section, index) in options.sections" :key="index">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-10">
                                    <input type="text" v-model="section.name" :name="`options[sections][${index}][name]`" :id="`sections_${index}_name`" class="form-control form-control-lg mb-2" :placeholder="`Seccion ${index}`">
                                    <textarea v-model="section.description" :name="`options[sections][${index}][description]`" :id="`description_${index}`" cols="30" rows="3" class="form-control tinymce" placeholder="Descripción"></textarea>
                                    <h5 class="mt-3">Preguntas de la sección</h5>
                                    <select v-model="section.actualquestion" class="form-control" @change="addQuestion(section)">
                                        <option value="">Seleccione una pregunta para añadirla a la sección</option>
                                        <option value="all">Agregar todas</option>
                                        <option v-for="(question,i) in filterQuestions(section)" :key="i" :value="question.identifier">{{question.identifier}} - {{question.options.enunciado.E1}}</option>
                                    </select>
                                    <ul></ul>
                                    <li v-for="(q,p) in section.questions" :key="p">
                                        <input type="hidden" :name="`options[sections][${index}][questions][${p}]`" :value="q">
                                        {{questionText(q)}} <a href="javascript:void(0)" class="float-right text-danger" @click="section.questions.splice(p,1)">Quitar</a>
                                    </li>
                                </div>
                                <div class="col-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-info btn-sm mb-2" @click="swap(index,index-1)"><i class="fa fa-fw fa-arrow-up"></i></button>
                                        </div>
                                        <div class="col-6">
                                            <button type="button" class="btn btn-info btn-sm mb-2" @click="swap(index,index+1)"><i class="fa fa-fw fa-arrow-down"></i></button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-lg mb-2" @click="options.sections.splice(index,1)">Remover</button>
                                    <div class="form-group mb-2">
                                        <label :for="`options_sections_${index}_aleatorio`"><input type="checkbox" v-model="section.aleatorio" :name="`options[sections][${index}][aleatorio]`" :id="`options_sections_${index}_aleatorio`" value="1"> Contenido Aleatorio</label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label :for="`options_sections_${index}_unico`"><input type="checkbox" v-model="section.unico" :name="`options[sections][${index}][unico]`" :id="`options_sections_${index}_unico`" value="1"> Una pregunta por pantalla</label>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label :for="`options_sections_${index}_process`"><input type="checkbox" v-model="section.process" :name="`options[sections][${index}][process]`" :id="`options_sections_${index}_process`" value="1"> Proccesar las preguntas de esta seccion</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <button type="button" class="btn btn-success mt-4" @click="addSeccion()">Nueva sección</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "instrument-options",
        props: ['instrument','questions'],
        
        data() {
            return {
                options: this.instrument.options && this.instrument.options != "null" ?this.instrument.options:{
                    sections:[]
                },
            }
        },

        computed: {
        },

        methods: {
            swap(i,j){
                let tmp = this.options.sections[i];
                this.$set(this.options.sections, i, this.options.sections[j]);
                this.$set(this.options.sections, j, tmp);
            },
            questionText(id){
                let element = this.questions.filter((el) => el.identifier == id )[0];
                return element? element.identifier + ' - ' + element.options.enunciado.E1:'--';
            },
            filterQuestions(section){
                return this.questions.filter(el => {
                    for(let i in section.questions){
                        if(section.questions[i] == el.identifier) return false;
                    }
                    return true;
                });
            },
            addSeccion(){
                this.options.sections.push({
                    name: '',
                    description: '',
                    options:'',
                    questions:[],
                    actualquestion: ''
                });
                tinymce.init({
                    selector: `#description_${this.options.sections.length}`,
                    menubar: 'file edit view insert format tools table tc help',
                    plugins: 'lists, advlist',
                    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                    height: 600,
                    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                    noneditable_noneditable_class: 'mceNonEditable',
                    toolbar_mode: 'sliding',
                    spellchecker_whitelist: ['Ephox', 'Moxiecode'],
                    tinycomments_mode: 'embedded',
                    content_style: '.mymention{ color: gray; }',
                    contextmenu: 'link image imagetools table configurepermanentpen',
                    a11y_advanced_options: true,
                    skin: useDarkMode ? 'oxide-dark' : 'oxide',
                    content_css: useDarkMode ? 'dark' : 'default',
                });
            },
            removeSeccion(index){
                this.options.sections.splice(index,1);
            },
            addQuestion(section){
                if(!section.questions) section.questions = [];
                if(section.actualquestion == 'all'){
                    let fq = this.filterQuestions(section)
                    for(let i in fq){
                        section.questions.push(fq[i].identifier);
                    }
                }else{
                    section.questions.push(section.actualquestion);
                }
                section.actualquestion = '';
            },
        }
    }
</script>

