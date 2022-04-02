<template>
	<div class="form-group">
		<label class="label">{{label}}</label>
		<input
			class="form-control"
			:class="{ 'is-invalid': hasError }"
			type="text"
			v-model="name"
			:placeholder="placeholder"
			:disabled="disabled"
		/>
		<div class="invalid-feedback" :class="{ 'd-block': hasError }">
			Este campo es requerido
		</div>
	</div>
</template>

<script>
import { mapMutations } from "vuex";

import validateOnSave from "./validateInputOnSaveMixin.js";

export default {
	name: "name-input",

	props: {
		errorKeyPrefix: String, 
		dataName: String, 
		disabled: Boolean, 
		storeData: Object, 
		type: String, 
		required: { default: true }
	},

	mixins: [validateOnSave],

	created() {
		//this.validate = this._.debounce(this.validate, 800);
	},

	data() {
		return {
			name: this.dataName,
			hasError: false,
		};
	},

	computed: {
		errorKey() {
			return `${this.errorKeyPrefix}_name_error`;
		},

		label(){
			return this.type && this.type == 'J'?'Razón social':'Nombres';
		},

		placeholder(){
			return this.type && this.type == 'J'?'Nombre de la empresa':'Primer y segundo nombre';
		}
	},

	methods: {
		...mapMutations({
			addError(commit, payload) {
				return commit(
					this.storeData.addError,
					payload
				);
			},
			removeError(commit, payload) {
				return commit(
					this.storeData.removeError,
					payload
				);
			}
		}),

		validate() {
			if (!this.name && this.required) {
				this.hasError = true;
				this.addError(this.errorKey);
			} else {
				this.hasError = false;
				this.removeError(this.errorKey);
			}
		}
	},

	watch: {
		name(newName) {
			this.$emit("changed", newName);
			this.validate();
		},

		dataName(newName) {
			this.name = newName;
		}
	}
};
</script>
