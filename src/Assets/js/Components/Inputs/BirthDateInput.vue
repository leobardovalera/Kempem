<template>
	<div class="form-group">
		<label class="label">Fecha de nacimiento</label>

		<v-date-picker
			mode="single"
			:min-date="minPickerDate"
			:max-date="maxPickerDate"
			v-model="birthdate"
			show-caps
		>
			<div slot-scope="{}">
				<input
					type="text"
					:value="inputValue"
					placeholder="dd/mm/aaaa"
					@input="update($event.target.value)"
					class="form-control"
					:class="{ 'is-invalid': hasError }"
				/>
			</div>
		</v-date-picker>
		<div class="invalid-feedback" :class="{ 'd-block': hasError }">
			La fecha no es válida
		</div>
	</div>
</template>

<script>
import { mapMutations } from "vuex";
import moment from "moment";
import validateOnSave from "./validateInputOnSaveMixin.js";

export default {
	name: "birth-date-input",

	props: ["errorKeyPrefix", "dataBirthdate", "ageRange", "storeData"],

	mixins: [validateOnSave],

	created() {
		this.update = this._.debounce(this.update, 1000);

		if (moment(this.dataBirthdate).isValid()) {
			this.birthdate = moment(this.dataBirthdate).toDate();
		}
	},

	data() {
		return {
			birthdate: null,
			inputValue: null,
			hasError: false
		};
	},

	computed: {
		minPickerDate() {
			return moment()
				.subtract(this.ageRange.to_age + 1, "years")
				.add(1, "day")
				.toDate();
		},

		maxPickerDate() {
			return moment()
				.subtract(this.ageRange.from_age, "years")
				.toDate();
		},

		errorKey() {
			return `${this.errorKeyPrefix}_date_error`;
		},

		outOfRange() {
			return this.$refs.inputValue;
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

		formatDateForInput(date, fromPicker = true) {
			if (!date) return null;

			if (fromPicker) {
				return moment(date).format("DD/MM/YYYY");
			}

			return date;
		},

		update(value) {
			this.inputValue = this.formatDateForInput(value, false);

			let date = moment(value, "DD/MM/YYYY");

			this.validate(date);

			if (!this.hasError) {
				this.birthdate = date.toDate();
			}
		},

		validate(date = null) {
			if (!date) date = this.birthdate;

			let givenAge = Math.floor(
				moment().diff(moment(date), "years", true)
			);

			if (
				!date ||
				!moment(date).isValid() ||
				givenAge < this.ageRange.from_age ||
				givenAge > this.ageRange.to_age
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
		birthdate(newBirthdate) {
			this.inputValue = this.formatDateForInput(newBirthdate);

			this.$emit("changed", newBirthdate);
			this.validate();
		}
	}
};
</script>
