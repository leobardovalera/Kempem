<template>
	<div class="doc-type select col-4" :class="{ 'is-invalid': hasError && dirty }">
		<select v-model="documentType" class="form-control" :class="{ 'is-invalid': hasError && dirty }">
			<option value="default" disabled>Tipo</option>
			<option
				v-for="(documentTypeOption, index) in documentsComputed"
				:value="documentTypeOption.id"
				v-text="documentTypeOption.name"
				:key="index"
			></option>
		</select>
		<div class="invalid-feedback" :class="{ 'd-block': hasError && dirty, 'd-none': !hasError || !dirty }">
			Tipo requerido
		</div>
	</div>
</template>

<script>
import { mapMutations } from "vuex";
import { mapState } from "vuex";

import validateOnSave from "./validateInputOnSaveMixin.js";

export default {
	name: "document-type-input",

	props: ["errorKeyPrefix", "passengerIndex", "storeData"],

	mixins: [validateOnSave],

	data() {
		return {
			documentType: this.dataDocumentType,
			hasError: false,
			dirty: false
		};
	},

	computed: {

		...mapState({
			selected: state => state.origin,
		}),
		...mapState({
			documentTypes(state, getters) {
				return [];//getters[this.storeData.namespace + "/allowedDocumentTypes"];
			}
		}),

		documentsComputed() {
			return this.documentTypes && this.documentTypes.length > 0
				? this.documentTypes
				: this.selected.document_types;
		},

		errorKey() {
			return `${this.errorKeyPrefix}_documentType_error`;
		}
	},

	created() {
		this.validate = this._.debounce(this.validate, 0);

		if (!this.documentType) this.documentType = "default";
	},

	methods: {
		...mapMutations({
			addError(commit, payload) {
				return commit(this.storeData.addError, payload);
			},
			removeError(commit, payload) {
				return commit(this.storeData.removeError, payload);
			}
		}),

		changeSelected(e) {
			this.productType = e.target.value;
			this.dirty = true;
		},

		validate() {
			this.dirty = true;
			if (!this.documentType || this.documentType == "default") {
				this.hasError = true;
				this.addError(this.errorKey);
			} else {
				this.hasError = false;
				this.removeError(this.errorKey);
			}
		}
	},

	watch: {
		documentType(newDocumentType) {
			this.$emit("changed", newDocumentType);
			//this.validate();
		}
	}
};
</script>
