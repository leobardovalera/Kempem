<template>
	<div class="col-8">
		<input
			class="form-control doc-number"
			:class="{ 'is-invalid': hasError }"
			type="text"
			v-model="documentNumber"
			placeholder="Número de documento"
		/>
		<div class="invalid-feedback" :class="{ 'd-block': hasError }">
			El número de documento es requerido
		</div>
	</div>
</template>

<script>
import { mapMutations } from "vuex";

import validateOnSave from "./validateInputOnSaveMixin.js";

export default {
	name: "document-number-input",

	props: ["errorKeyPrefix", "dataDocumentNumber", "storeData"],

	mixins: [validateOnSave],

	created() {
		this.validate = this._.debounce(this.validate, 800);
	},

	data() {
		return {
			documentNumber: this.dataDocumentNumber,
			hasError: false
		};
	},

	computed: {
		errorKey() {
			return `${this.errorKeyPrefix}_documentNumber_error`;
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
			if (!this.documentNumber) {
				this.hasError = true;
				this.addError(this.errorKey);
			} else {
				this.hasError = false;
				this.removeError(this.errorKey);
			}
		}
	},

	watch: {
		documentNumber(newDocumentNumber) {
			this.$emit("changed", newDocumentNumber);
			this.validate();
		}
	}
};
</script>
