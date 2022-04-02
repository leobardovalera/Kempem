<template>
	<div class="form-group">
		<label class="label">Dirección de facturación</label>
		<textarea
			v-model="address"
			class="form-control"
			:class="{ 'is-invalid': hasError }"
			type="text"
			placeholder="Dirección"
		></textarea>
		<div class="invalid-feedback" :class="{ 'd-block': hasError }">
			La dirección es requerida
		</div>
	</div>
</template>

<script>
import { mapMutations } from "vuex";

import validateOnSave from "./validateInputOnSaveMixin.js";

export default {
	name: "name-input",

	props: ["errorKeyPrefix", "dataAddress", "disabled", "storeData"],

	mixins: [validateOnSave],

	created() {
		this.validate = this._.debounce(this.validate, 800);
	},

	data() {
		return {
			address: this.dataAddress,
			hasError: false
		};
	},

	computed: {
		errorKey() {
			return `${this.errorKeyPrefix}_address_error`;
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
			if (!this.address) {
				this.hasError = true;
				this.addError(this.errorKey);
			} else {
				this.hasError = false;
				this.removeError(this.errorKey);
			}
		}
	},

	watch: {
		address(newAddress) {
			this.$emit("changed", newAddress);
			this.validate();
		},

		dataAddress(newAddress) {
			this.address = newAddress;
			this.$emit("changed", newAddress);
			this.validate();
		}
	}
};
</script>
