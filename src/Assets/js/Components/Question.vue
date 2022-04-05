<template>
    <div id="question" class="question-space" :class="`q${data.type}`">
        <div class="mb-4" v-if="data.type =='17'">
            <div v-html="enunciado(data)" class="lead text-center mb-3 mb-md-4"></div>
            <div class="row no-gutters mb-4">
                <div class="col text-center">
                    <div class="liker-group btn-group btn-group-toggle">
                        <label class="btn-liker btn" v-for="index in 7" :key="index" :class="btnClass(index,value)">
                            <input type="radio" @click="value = index"> 
                            <h1>{{index}}</h1>
                            <span>{{likert[index-1]}}</span>
                        </label>
                    </div>
                </div>
            </div>
            <p class="d-none d-md-block text-center"><small>Puede usar las teclas del 1 al 7 de su teclado</small></p>
        </div>

        <div class="mb-4" v-else-if="data.type =='RA'">
            <div class="row">
                <div class="col required" data-type="radio">
                    <label :for="`RA_${data.id}`" v-html="enunciado(data)"></label>
                    <div class="custom-control custom-radio" v-for="(op,index) in data.options.opciones" :key="index">
                        <input type="radio" v-model="value" :value="op" @change="update" class="required custom-control-input" :id="`RA_${data.id}_${index}`" required>
                        <label class="custom-control-label" :for="`RA_${data.id}_${index}`">{{op}}</label>
                    </div>
                    <div class="invalid-feedback">
                        Debe seleccionar una respuesta
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4" v-else-if="data.type =='DT'">
            <div class="row">
                <div class="col">
                    <label v-html="enunciado(data)" :for="`DT_${data.id}`"></label>
                    <v-date-picker v-model="value" @change="update">
                        <template v-slot="{ inputValue, inputEvents }">
                            <input
                                class="required form-control"
                                :id="`DT_${data.id}`"
                                :value="inputValue"
                                v-on="inputEvents"
                                placeholder="dd/mm/yyyy"
                            />
                            <div class="invalid-feedback">
                                Este valor es requerido
                            </div>
                    </template>
                    </v-date-picker>
                </div>
            </div>
        </div>

        <div class="mb-4" v-else-if="data.type =='SE'">
            <div class="row">
                <div class="col">
                    <label v-html="enunciado(data)" :for="`SE_${data.id}`"></label>
                    <select v-model="value" name="" class="required form-control" @change="update">
                        <option value=""></option>
                        <option v-for="(op,i) in data.options.opciones" :key="i" :value="op">{{op}}</option>
                    </select>
                    <div class="invalid-feedback">
                        Este valor es requerido
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4" v-else-if="data.type =='TX'">
            <div class="row">
                <div class="col">
                    <label v-html="enunciado(data)" :for="`TX_${data.id}`"></label>
                    <input type="text" v-model="value" @change="update" class="required form-control">
                    <div class="invalid-feedback">
                        Este valor es requerido
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4" v-else-if="data.type =='NU'">
            <div class="row">
                <div class="col">
                    <label v-html="enunciado(data)" :for="`DT_${data.id}`"></label>
                    <input type="number" v-model="value" @change="update" class="required form-control">
                    <div class="invalid-feedback">
                        Este valor es requerido
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4" v-else-if="data.type =='CB'">
            <div class="row">
                <div class="col">
                    <input class="form-check-input required" :id="`CB_${data.id}`" data-type="checkbox" type="checkbox" @click="update" v-model="value"> 
                    <label class="form-check-label" :for="`CB_${data.id}`">
                        <span v-html="enunciado(data)"></span>
                    </label>
                    <div class="invalid-feedback">
                        Debe seleccionar la casilla
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4" v-else-if="data.type =='YN'">
            <div class="row">
                <div class="col required" data-type="radio">
                    <label v-html="enunciado(data)" :for="`DT_${data.id}`"></label>
                    <div class="custom-control custom-radio">
                        <input type="radio" v-model="value" value="Si" @change="update" class="custom-control-input" :id="`YN_${data.id}_Si`" required>
                        <label class="custom-control-label" :for="`YN_${data.id}_Si`">Si</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" v-model="value" value="No" @change="update" class="custom-control-input" :id="`YN_${data.id}_No`" required>
                        <label class="custom-control-label" :for="`YN_${data.id}_No`">No</label>
                    </div>
                    <div class="invalid-feedback">
                        Debe seleccionar una respuesta (You must select an answer)
                    </div>
                </div>
            </div>
        </div>


        
    </div>
</template>

<script>
    export default {
        name: "question",
        props: ['data','version'],
        
        data() {
            return {
                selectedValue: 0,
                value:null,
                disable: false,
                likert: [
                    "Totalmente en desacuerdo (strongly disagree) ",
                    "En desacuerdo (disagree)",
                    "Algo en desacuerdo (Something disagree)",
                    "Indiferente (Indifferent)",
                    "Algo de acuerdo (Somewhat agree)",
                    "De acuerdo (Agree)",
                    "Totalmente de acuerdo (Totally agree)",
                ]
            }
        },

        computed: {
        },

        methods: {
            btnClass(i,v){
                return i == v?`btn-active-liker btn-active-liker${i}`:`btn-liker${i}`;
            },
            enunciado(data){

                switch(this.version){
                    case 1:
                        return data.options.enunciado.E1;
                    case 2:
                        return data.options.enunciado.E2 == "" || data.options.enunciado.E2 == null?data.options.enunciado.E1:data.options.enunciado.E2;
                    case 3:
                        return data.options.enunciado.E3 == "" || data.options.enunciado.E3 == null?data.options.enunciado.E1:data.options.enunciado.E3;
                }
            },
            update(event){
                event.target.classList.remove("is-invalid");
            }
        },
        watch:{
            value: function(nw,ol){
                if(this.disable && this.data.type == '17') { return; }
                this.disable = true;
                this.$emit('answer', {'id': this.data.identifier,'value': nw,'type': this.data.type});
            }
        }
    }
</script>

