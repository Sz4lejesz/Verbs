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
			<div class="new">NOWY</div>
			<input type="text" class="searching-input" placeholder="czego szukamy?">
		</div>
		<div class="add-verb" v-if="addVerbPopUp">
<!--				<strong>Dodaj nowy czasownik</strong> <br>-->
<!--				<label for="PL">pl</label>-->
<!--				<input type="text" class="" id="PL" v-model="newVerb.verbInPolish"> <br>-->
<!--				<label for="infinitive">infinitive</label>-->
<!--				<input type="text" class="" id="infinitive" v-model="newVerb.verbInInfinitive"> <br>-->
<!--				<label for="pastSimple1">Past Simple *</label>-->
<!--				<input type="text" class="" id="pastSimple1" v-model="newVerb.verbInPastSimple1">-->
<!--				<label for="pastSimple2">Past Simple </label>-->
<!--				<input type="text" class="" id="pastSimple2" v-model="newVerb.verbInPastSimple2"> <br>-->
<!--				<label for="pastParticiple1">Past Participle *</label>-->
<!--				<input type="text" class="" id="pastParticiple1" v-model="newVerb.verbInPastParticiple1">-->
<!--				<label for="pastParticiple2">Past Participle </label>-->
<!--				<input type="text" class="" id="pastParticiple2" v-model="newVerb.verbInPastParticiple2"> <br>-->
<!--				<label for="additionalDescription">Dodatkowy opis PL </label>-->
<!--				<input type="text" class="" id="additionalDescription" v-model="newVerb.additionalDescription"> <br>-->
<!--				<button @click="addVerbPopUp = false">zamknij</button> <br>-->
<!--				<button @click="saveVerb()">Wyślij</button>-->
			</div> <br> <br> <br>
			<div class="verb-list" v-for="verb in verbsObject">
				{{ verb.verbInPolish }} -
				{{ verb.verbInInfinitive }} -
				{{ verb.verbInPastSimple1 }} ->
				{{ verb.verbInPastSimple2 }}
				{{ verb.verbInPastParticiple1 }}
				{{ verb.verbInPastParticiple2 }}
				{{ verb.additionalDescription }}
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
					console.log(data)
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
