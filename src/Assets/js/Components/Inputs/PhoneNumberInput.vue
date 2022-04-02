<template>
	<div class="form-group">
		<label class="label">Número telefónico</label>
		<VuePhoneNumberInput 
			v-model="phoneNumber"
			:value="123"
			:default-country-code="defaultCountry" 
			:preferredCountries="preferred"
			:disabledFetchingCountry="true"
			placeholder="Número telefónico"
			:class="{ 'is-invalid': hasError }"
			:disabled="disabled"
			:translations="translations" />
		<div class="invalid-feedback" :class="{ 'd-block': hasError }">Este campo es requerido</div>
	</div>
</template>

<script>
import { mapState } from "vuex";
import { mapMutations } from "vuex";

import VuePhoneNumberInput from 'vue-phone-number-input';

import validateOnSave from "./validateInputOnSaveMixin.js";

export default {
	name: "phone-number-input",

	props: ["errorKeyPrefix", "dataPhoneNumber", "ageRange", "disabled", "storeData"],

	mixins: [validateOnSave],

	data() {
		return {
			phoneNumber: null,
			hasError: false,
			defaultCountry:'VE',
			origins: [],
			translations:{
				countrySelectorLabel: 'Código',
				countrySelectorError: 'Seleccione un país',
				phoneNumberLabel: 'Número de teléfono',
				example: 'Ejemplo:'
			},
		};
	},

	components: {
		VuePhoneNumberInput
	},

	created() {
		this.validate = this._.debounce(this.validate, 800);

		this.phoneNumber = this.dataPhoneNumber;

		this.$axios.get(`/origins/code`).then(code => {
			this.defaultCountry = code.data;
		});
		this.$axios.get(`/origins/all?quotes-system=${this.quotesSystem.id}`).then(origins => {
			this.origins = origins.data;
		});
	},

	computed: {
		errorKey() {
			return `${this.errorKeyPrefix}_phoneNumber_error`;
		},

		preferred() {
			var pref = [];
			for (let i in this.origins) {
				pref.push(this.origins[i].country.code);
			}
			return pref;
		}
	},

	methods: {
		...mapMutations({
			addError(commit, payload) {
				return commit(this.storeData.namespace + "/" + this.storeData.addError, payload);
			},
			removeError(commit, payload) {
				return commit(this.storeData.namespace + "/" + this.storeData.removeError, payload);
			}
		}),

		validate() {
			if (!this.phoneNumber) {
				this.hasError = true;
				this.addError(this.errorKey);
			} else {
				this.hasError = false;
				this.removeError(this.errorKey);
			}
		},
	},

	watch: {
		phoneNumber(newPhoneNumber) {
			this.$emit("changed", newPhoneNumber);
			this.validate();
		},

		dataPhoneNumber(newPhoneNumber) {
			this.phoneNumber = newPhoneNumber;
		}
	}
};
</script>
