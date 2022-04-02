<template>
	<div>
		<label class="d-block" :class="{ 'text-danger': hasError }" v-for="(option, index) in options" :key="index" :for="`acumula_${option.value}`">
			<input :id="`acumula_${option.value}`" 					
				:class="{ 'is-invalid': hasError }"
				type="radio" 
				v-model="name" 
				:disabled="disabled"
				:value="option.value"> {{option.text}}
		</label>

		<div class="invalid-feedback" :class="{ 'd-block': hasError }">
			Este campo es requerido
		</div>
	</div>
</template>

<script>
import { mapMutations } from "vuex";

import validateOnSave from "./validateInputOnSaveMixin.js";

export default {
	name: "radio-input",

	props: ["errorKeyPrefix", "dataName", "disabled", "storeData", "options"],

	mixins: [validateOnSave],

	created() {
		this.validate = this._.debounce(this.validate, 800);
	},

	data() {
		return {
			name: this.dataName,
			hasError: false,
		};
	},

	computed: {
		errorKey() {
			return `${this.errorKeyPrefix}_radio_error`;
		},
	},

	methods: {
		...mapMutations({
			addError(commit, payload) {
				return commit(
					this.storeData.namespace + "/" + this.storeData.addError,
					payload
				);
			},
			removeError(commit, payload) {
				return commit(
					this.storeData.namespace + "/" + this.storeData.removeError,
					payload
				);
			}
		}),

		validate() {
			if (this.name === null) {
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
