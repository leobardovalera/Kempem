<template>
	<div class="form-group">
		<label class="label">Apellidos</label>
		<input
			class="form-control"
			:class="{ 'is-invalid': hasError }"
			type="text"
			v-model="lastname"
			placeholder="Primer y segundo apellido"
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
	name: "lastname-input",

	props: {
		errorKeyPrefix: String, 
		dataLastname: String, 
		disabled: Boolean, 
		storeData: Object, 
		required: { default: true }
	},

	mixins: [validateOnSave],

	created() {
		this.validate = this._.debounce(this.validate, 800);
	},

	data() {
		return {
			lastname: this.dataLastname,
			hasError: false
		};
	},

	computed: {
		errorKey() {
			return `${this.errorKeyPrefix}_lastname_error`;
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
			if (!this.lastname && this.required) {
				this.hasError = true;
				this.addError(this.errorKey);
			} else {
				this.hasError = false;
				this.removeError(this.errorKey);
			}
		}
	},

	watch: {
		lastname(newLastname) {
			this.$emit("changed", newLastname);
			this.validate();
		},

		dataLastname(newLastname) {
			this.lastname = newLastname;
		}
	}
};
</script>
