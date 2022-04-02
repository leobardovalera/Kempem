import { mapMutations } from "vuex";

export default {
	created() {
		this.events.$on( "save-order", () => this.validate() )
	},

	beforeDestroy(){
		this.events.$off( "save-order" );
	}
};
