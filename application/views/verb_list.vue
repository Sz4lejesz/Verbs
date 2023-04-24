<?php
require_once 'header.php';
?>

<div id="app">
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
			<input type="text" class="searching-input" placeholder="czego szukamy?">
		</div>
		<div class="overlay" v-if="addVerbPopUp"></div>
		<div class="clearfix"></div>
		<div class="add-verb" v-if="addVerbPopUp">
			<div class="new-verb">Nowy czasownik</div>
			<div class="stripe"></div>
			<div class="z-index-PL">PL *</div>
			<input type="text" class="PL-input" id="PL" v-model="newVerb.verbInPolish">
			<div class="z-index-infinitive">Infinitive</div>
			<input type="text" class="infinitive-input" id="infinitive" v-model="newVerb.verbInInfinitive">
			<div class="clearfix"></div>
			<div class="z-index-simple1">Past Simple *</div>
			<input type="text" class="past-simple-1-input" id="pastSimple1" v-model="newVerb.verbInPastSimple1">
			<div class="z-index-simple2">Past Simple</div>
			<input type="text" class="past-simple-2-input" id="pastSimple2" v-model="newVerb.verbInPastSimple2">
			<div class="clearfix"></div>
			<div class="z-index-participle1">Past Participle *</div>
			<input type="text" class="past-participle-1-input" id="pastParticiple1" v-model="newVerb.verbInPastParticiple1">
			<div class="z-index-participle2">Past Participle</div>
			<input type="text" class="past-participle-2-input" id="pastParticiple2" v-model="newVerb.verbInPastParticiple2">
			<div class="z-index-description">PL Dodatkowy Opis</div>
			<textarea name="groupAdditional" rows="2" class="form-control" id="additionalDescription" v-model="newVerb.additionalDescription"></textarea>
			<div class="clearfix"></div>
			<img src="images/cross.png" alt="dasd">
			<button @click="addVerbPopUp = false" class="close-button">zamknij</button>
			<button @click="saveVerb()" class="save-button">DODAJ</button>
		</div>
		<div class="clearfix"></div>
			<div class="verb-list" v-for="verb in verbsObject">
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
			<div class="announcement"></div>
			{{ announcement }}
	</div>
</div>

<script>
const { createApp } = Vue
createApp({
	data() {
		return {
			addVerbPopUp: true,
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
			axios.post('Verbs/saveVerbs',

				{newVerb: this.newVerb}, {
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				})
				.then(function (response) {
					if (response.data.result) {
						app.verbsObject = {};
						app.announcement = 'Udało się';
						app.addVerbPopUp = false;
						app.verbsObject = response.data.verbs;
					} else {
						app.announcement = 'Nie udało się';
					}
					console.log(response.data);
				})
				.catch(function (error) {
					console.log(error);
				});
		},
		showVerbs() {
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
	}

}).mount('#app')
</script>

<?php
require_once 'footer.php';
?>
