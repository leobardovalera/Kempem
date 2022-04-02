<template>
	<div class="form-group">
		<label class="label">Correo electrónico</label>
		<input
			class="form-control"
			:class="{ 'is-invalid': hasError }"
			type="email"
			v-model="email"
			placeholder="nombre@dominio.com"
			:disabled="disabled"
		/>
		<div class="invalid-feedback" :class="{ 'd-block': hasError }">
			Se require un email valido
		</div>
	</div>
</template>

<script>
import { mapMutations } from "vuex";

import validateOnSave from "./validateInputOnSaveMixin.js";

import emailValidator from "email-validator";

export default {
	name: "email-input",

	props: ["errorKeyPrefix", "dataEmail", "ageRange", "disabled", "storeData"],

	mixins: [validateOnSave],

	created() {
		this.validate = this._.debounce(this.validate, 800);
	},

	data() {
		return {
			email: this.dataEmail,
			hasError: false
		};
	},

	computed: {
		errorKey() {
			return `${this.errorKeyPrefix}_email_error`;
		}
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
			if (
				(!this.ageRange && !this.email) ||
				(this.email && !emailValidator.validate(this.email)) ||
				(this.ageRange && this.ageRange.from_age && !this.email)
			) {
				this.hasError = true;
				this.addError(this.errorKey);
			} else {
				this.hasError = false;
				this.removeError(this.errorKey);
			}
		}
	},

	watch: {
		email(newEmail) {
			this.$emit("changed", newEmail);
			this.validate();
		},

		dataEmail(newEmail) {
			this.email = newEmail;
		}
	}
};
</script>
