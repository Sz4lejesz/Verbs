<?php
require_once 'header.php';
?>

<div id="app">
	<div class="box">
		<div class="menu">
			<div class="learning">nauka</div>
			<div class="verbs" @click="goToVerbs">czasowniki</div>
			<div class="words">słowa</div>
			<div class="groups">grupy</div>
			<div class="name">Marcin</div>
		</div>
		<div class="clearfix"></div>
		<div class="randomized-verb" v-if="verbInPolishMODE">{{ x.main }}</div>
		<div class="randomized-verb" v-if="verbInInfinitiveMODE">{{ x.main }}</div>
		<div class="randomized-verb" v-if="verbInPastSimpleMODE">{{ x.main }}</div>
		<div class="randomized-verb" v-if="verbInPastParticipleMODE">{{ x.main }}</div>
		<img src="content/images/settings.png" height="21" width="21" class="settings" @click="settingsPopUp = true"/>
		<div class="clearfix"></div>
		<div class="learning-stripe"></div>
		<div class="learning-inputs-box">
			<div class="" v-if="verbInPolishMODE">
				<div class="learning-infinitive-z-index">Infitive</div>
				<div class="learning-past-simple-z-index">Past Simple</div>
				<div class="learning-past-participle-z-index">Past Participle</div>
				<input type="text" class="learning-infinitive-input" v-model="verbs.verbInInfinitive">
				<input type="text" class="learning-past-simple-input" v-model="verbs.verbInPastSimple">
				<input type="text" class="learning-infinitive-input" v-model="verbs.verbInPastParticiple">
			</div>
			<div class="" v-if="verbInPastSimpleMODE">
				<div class="learning-infinitive-z-index">Po Polsku</div>
				<div class="learning-past-simple-z-index">Infinitive</div>
				<div class="learning-past-participle-z-index">Past Participle</div>
				<input type="text" class="learning-infinitive-input" v-model="verbs.verbInPolish">
				<input type="text" class="learning-past-simple-input" v-model="verbs.verbInInfinitive">
				<input type="text" class="learning-infinitive-input" v-model="verbs.verbInPastParticiple">
			</div>
			<div class="" v-if="verbInInfinitiveMODE">
				<div class="learning-infinitive-z-index">Po Polsku</div>
				<div class="learning-past-simple-z-index">Past Simple</div>
				<div class="learning-past-participle-z-index">Past Participle</div>
				<input type="text" class="learning-infinitive-input" v-model="verbs.verbInPolish">
				<input type="text" class="learning-past-simple-input" v-model="verbs.verbInPastSimple">
				<input type="text" class="learning-infinitive-input" v-model="verbs.verbInPastParticiple">
			</div>
			<div class="" v-if="verbInPastParticipleMODE">
				<div class="learning-infinitive-z-index">Po polsku</div>
				<div class="learning-past-simple-z-index">Infinitive</div>
				<div class="learning-past-participle-z-index">Past Simple</div>
				<input type="text" class="learning-infinitive-input" v-model="verbs.verbInPolish">
				<input type="text" class="learning-past-simple-input" v-model="verbs.verbInInfinitive">
				<input type="text" class="learning-infinitive-input" v-model="verbs.verbInPastSimple">
			</div>

		</div>
		<div class="overlay" v-if="settingsPopUp"></div>
		<div class="clearfix"></div>
		<div class="learning-settings" v-if="settingsPopUp">
			<div class="learning-row">Pytanie o czasownik</div>
			<select @change="verbFormChange($event)" class="custom-select">
				<option value="verbInPolish" selected="selected" v-model="">PL</option>
				<option value="verbInInfinitive">EN Infinitive</option>
				<option value="verbInPastSimple1">EN Past simple</option>
				<option value="verbInPastParticiple1">EN Past participle</option>
				<option value="5">Losowo</option>
			</select>
			<div class="clearfix"></div>
			<div class="learning-stripe"></div>
			<div class="learning-row">Nie wyświetlaj tych które już umiem</div>
			<input type="checkbox" id="switch"/><label for="switch"></label>
			<div class="clearfix"></div>
			<div class="learning-stripe"></div>
			<div class="learning-row">Używać pełnej listy czasowników?</div>
<!--			<input2 type="checkbox" id="switch2" /><label2 for="switch2"></label2>-->
			<div class="clearfix"></div>
			<div class="learning-stripe"></div>
			<div class="apply-settings float-right" @click="settingsPopUp = false, drawVerb()" >Zastosuj</div>
		</div>
		<div class="clearfix"></div>
		<div class="learning-stripe"></div>
		<div class="check-button" @click="checkTranslation()" >🤔&nbspSprawdź</div>
		<div class="learning-button" @click="learningPopUp = !learningPopUp">🤓&nbspNauka</div>
		<div class="learning-button" @click="drawVerb()">🙀&nbspNowy</div>
		<div class="add-to-group-button">✔️&nbspDodaj do grupy</div>
		<div class="clearfix"></div>
		<div class="learning-announcement">{{ announcement }}</div>
		<div class="correct-results-box" v-if="learningPopUp">
			<div class="overlay" v-if="settingsPopUp"></div>
			<div class="learning-stripe mt-15"></div>
			<div class="clearfix"></div>
			<div class="mt-15">Poprawne odpowiedzi:</div>
			<div class="correct-results">{{ verbInPolish }} - {{ verbInInfinitive }} - {{ verbInPastSimple }} - {{ verbInPastParticiple }}</div>
		</div>
	</div>
</div>
<script>
const { createApp } = Vue
createApp({
	data() {
		return {
			verbInPolishMODE: true,
			verbInPastParticipleMODE: false,
			verbInPastSimpleMODE: false,
			verbInInfinitiveMODE: false,
			settingsPopUp: false,
			learningPopUp: false,
			announcement: '',
			verbInInfinitive: '',
			verbInPastSimple: '',
			verbInPastParticiple: '',
			verbInPolish: '',
			verbs: {
				verbInPolish: '',
				verbInInfinitive: '',
				verbInPastSimple: '',
				verbInPastParticiple: ''
			},
			x: {
				main: null,
				choosen: 'verbInPolish'
			}
		}
	},
	methods: {
		goToVerbs()
		{
			window.location = 'http://localhost/verbs/verb_list'
		},
		drawVerb()
		{
			let app = this;
			axios.get('Learning/drawVerbs')
				.then(function (response) {
					if (response.data) {
						app.verbInPolish = response.data.verbInPolish;
						app.verbInInfinitive = response.data.verbInInfinitive;
						app.verbInPastSimple = response.data.verbInPastSimple1;
						app.verbInPastParticiple = response.data.verbInPastParticiple1;
						switch (app.x.choosen) {
							case 'verbInInfinitive':
								app.verbs.verbInInfinitive = response.data.verbInInfinitive;
								if (app.announcement === 'Wszystko ok!') {
									app.verbs.verbInPolish = '';
									app.verbs.verbInPastSimple = '';
									app.verbs.verbInPastParticiple = '';
									app.announcement = '';
								}
								break
							case 'verbInPolish':
								app.verbs.verbInPolish = response.data.verbInPolish;
								if (app.announcement === 'Wszystko ok!') {
									app.verbs.verbInInfinitive = '';
									app.verbs.verbInPastSimple = '';
									app.verbs.verbInPastParticiple = '';
									app.announcement = '';
								}
								break
							case 'verbInPastSimple1':
								app.verbs.verbInPastSimple = response.data.verbInPastSimple1
								if (app.announcement === 'Wszystko ok!') {
									app.verbs.verbInInfinitive = '';
									app.verbs.verbInPolish = '';
									app.verbs.verbInPastParticiple = '';
									app.announcement = '';
								}
								break
							case 'verbInPastParticiple1':
								app.verbs.verbInPastParticiple = response.data.verbInPastParticiple1
								if (app.announcement === 'Wszystko ok!') {
									app.verbs.verbInInfinitive = '';
									app.verbs.verbInPastSimple = '';
									app.verbs.verbInPolish = '';
									app.announcement = '';
								}
						}
						console.log(app.announcement)
						app.x.main = response.data[app.x.choosen];
					}
				})
				.catch(function (error) {
					console.log(error);
				});
		},
		checkTranslation()
		{
			let app = this;
			axios.post('Learning/checkTranslation',
				{verbs: this.verbs, x: this.x}, {
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				})
				.then(function (response) {
					if (response.data) {
						app.announcement = response.data;
					}

				})
				.catch(function (error) {
					console.log(error);
				});
		},
		verbFormChange(e)
		{
			let app = this;
			this.x.choosen = e.srcElement.value
			switch (this.x.choosen){
				case 'verbInInfinitive':
					this.verbInInfinitiveMODE = true;
					this.verbInPolishMODE = false;
					this.verbInPastParticipleMODE = false;
					this.verbInPastSimpleMODE = false;
					break;
				case 'verbInPolish':
					this.verbInInfinitiveMODE = false;
					this.verbInPolishMODE = true;
					this.verbInPastParticipleMODE = false;
					this.verbInPastSimpleMODE = false;
					break;
				case 'verbInPastSimple1':
					this.verbInInfinitiveMODE = false;
					this.verbInPolishMODE = false;
					this.verbInPastParticipleMODE = false;
					this.verbInPastSimpleMODE = true;
					break;
				case 'verbInPastParticiple1':
					this.verbInInfinitiveMODE = false;
					this.verbInPolishMODE = false;
					this.verbInPastParticipleMODE = true;
					this.verbInPastSimpleMODE = false;
			}
		}
	},
	created() {
		this.drawVerb();
	},
	computed: {
	}

}).mount('#app')
</script>

<?php
require_once 'footer.php';
?>
