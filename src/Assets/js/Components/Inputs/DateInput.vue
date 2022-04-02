<template>
	<div class="form-group">
		<label class="label">{{labeltxt}}</label>
		<v-date-picker
			mode="single"
			:min-date="minPickerDate"
			:max-date="maxPickerDate"
			v-model="date"
			show-caps
		>
			<div slot-scope="{}">
				<input
					type="text"
					:value="inputValue"
					placeholder="Agregar fechas"
					@input="update($event.target.value)"
					class="form-control"
					:disabled="disabled"
					:class="{ 'is-invalid' : hasError }"
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
	name: "date-input",

	props: ["labeltxt","minPickerDate","maxPickerDate","value","disabled"],

	mixins: [validateOnSave],

	data() {
		return {
			date: null,
			inputValue: null,
			hasError: false
		};
	},

	methods: {

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
				this.date = date.toDate();
			}
		},

		validate(date = null) {
			if (!date) {return;}

			let givenAge = Math.floor(
				moment().diff(moment(date), "years", true)
			);

			if (!moment(date).isValid() /*||
				givenAge < this.ageRange.from_age ||
				givenAge > this.ageRange.to_age*/
			) {
				this.hasError = true;
			} else {
				this.hasError = false;
			}
		}
	},

	watch: {
		date(newdate) {
			this.inputValue = this.formatDateForInput(newdate);

			this.$emit("changed", newdate );
			this.validate();
		}
	}
};
</script>
