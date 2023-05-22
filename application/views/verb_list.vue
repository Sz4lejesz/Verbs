<?php
require_once 'header.php';
?>

<div id="app">
{{ filter }}
	<div class="box">
		<div class="menu">
			<div class="learning" id="learning">nauka</div>
			<div class="verbs">czasowniki</div>
			<div class="words">słowa</div>
			<div class="groups">grupy</div>
			<div class="name">Marcin</div>
		</div>
		<div class="clearfix"></div>
		<div class="new-verb-button">
			<div class="all-verbs">Wszystkie czasowniki</div>
			<div class="new" @click="addVerbPopUp = true">NOWY</div>
			<input autocomplete="off" type="text" class="searching-input" v-model="filter" placeholder="czego szukamy?">
		</div>
		<div class="overlay" v-if="addVerbPopUp"></div>
		<div class="clearfix"></div>
		<div class="add-verb" v-if="addVerbPopUp">
			<div class="new-verb">Nowy czasownik</div>
			<img src="content/images/cross.png" height="22" width="20" @click="addVerbPopUp = false" class="close-button"/>
			<div class="stripe"></div>
			<div class="z-index-PL">PL *</div>
			<input autocomplete="off" type="text" class="PL-input" v-model="newVerb.verbInPolish">
			<div class="z-index-infinitive">Infinitive *</div>
			<input autocomplete="off" type="text" class="infinitive-input" v-model="newVerb.verbInInfinitive">
			<div class="clearfix"></div>
			<div class="z-index-simple1">Past Simple *</div>
			<input autocomplete="off" type="text" class="past-simple-1-input" v-model="newVerb.verbInPastSimple1">
			<div class="z-index-simple2">Past Simple</div>
			<input autocomplete="off" type="text" class="past-simple-2-input" v-model="newVerb.verbInPastSimple2">
			<div class="clearfix"></div>
			<div class="z-index-participle1">Past Participle *</div>
			<input autocomplete="off" type="text" class="past-participle-1-input" v-model="newVerb.verbInPastParticiple1">
			<div class="z-index-participle2">Past Participle</div>
			<input autocomplete="off" type="text" class="past-participle-2-input" v-model="newVerb.verbInPastParticiple2">
			<div class="z-index-description">PL Dodatkowy Opis</div>
			<textarea name="groupAdditional" class="additional-description" v-model="newVerb.additionalDescription"></textarea>
			<div class="clearfix"></div>
			<button @click="saveVerb()" class="save-button">DODAJ</button>
			<div class="announcement"> {{ announcement }}</div>
		</div>
		<div class="clearfix"></div>
		<div class="verb-list" v-for="verb in verbsFilter">
				<div class="verbs-list">
					{{ verb.verbInInfinitive }} -
					{{ verb.verbInPastSimple1 }} -
					{{ verb.verbInPastParticiple1 }} ->
					{{ verb.verbInPolish }}
				</div>
				<div class="delete">usuń</div>
				<div class="edit">edytuj</div>
				<div class="clearfix"></div>
			</div>
	</div>
</div>
<script>
const { createApp } = Vue
createApp({
	data() {
		return {
			filter: '',
			addVerbPopUp: false,
			announcement: '',
			verbsObject: {},
			newVerb: {
				verbInPolish: '',
				verbInInfinitive: '',
				verbInPastSimple1: '',
				verbInPastSimple2: '',
				verbInPastParticiple1: '',
				verbInPastParticiple2: '',
				additionalDescription: ''
			},
		}
	},
	methods: {
		saveVerb() {
			let app = this;
			axios.post('Verb_list/saveVerbs',
				{newVerb: this.newVerb}, {
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				})
				.then(function (response) {
					if (response.data.result) {
						app.verbsObject = {};  // po co to
						app.announcement = 'Dodano do bazy';
						app.verbsObject = response.data.verbs;
						app.newVerb = {
								verbInPolish: '',
								verbInInfinitive: '',
								verbInPastSimple1: '',
								verbInPastSimple2: '',
								verbInPastParticiple1: '',
								verbInPastParticiple2: '',
								additionalDescription: ''
						};
					} else {
						app.announcement = 'Nie dodano do bazy';
					}
				})
				.catch(function (error) {
					console.log(error);
				});
		},
		showVerbs()
		{
			let app = this;
			axios.post('Verb_list/showVerbs',

				{newVerb: this.newVerb}, {
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				})
				.then(function (response) {
					if (response.data.verbs) {
						app.verbsObject = {};
						app.verbsObject = response.data.verbs;
					}
				})
				.catch(function (error) {
					console.log(error);
				});
		}
	},
	created() {
		this.showVerbs();
	},
	computed: {
		verbsFilter: function()
		{
			return this.verbsObject.filter((verb) => {
				let vII = verb.verbInInfinitive.toLowerCase().match(this.filter.toLowerCase());
				let vIPS1 = verb.verbInPastSimple1.toLowerCase().match(this.filter.toLowerCase());
				let vIPP1 = verb.verbInPastParticiple1.toLowerCase().match(this.filter.toLowerCase())
				let vIP = verb.verbInPolish.toLowerCase().match(this.filter.toLowerCase());
				return vII || vIPS1 || vIPP1 || vIP;
			})
		}
	}

}).mount('#app')
</script>

<?php
require_once 'footer.php';
?>
