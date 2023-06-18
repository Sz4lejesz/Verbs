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
			<option value="verbInPolish" selected="selected">PL</option>
			<option value="verbInInfinitive">EN Infinitive</option>
			<option value="verbInPastSimple1">EN Past simple</option>
			<option value="verbInPastParticiple1">EN Past participle</option>
			<option value="5">Losowo</option>
		</select>
		<div class="clearfix"></div>
		<div class="learning-stripe"></div>
		<div class="learning-row">Nie wyświetlaj tych które już umiem</div>
		<input type="checkbox" @click="showMistakesBox = !showMistakesBox" id="switch"/><label for="switch"></label>
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
<div class="mistakes-box" v-if="showMistakesBox">
	<div class="left-to-learn">
		<div class="left">Pozostało</div>
		<div class="left-number">{{ verbsLeftToLearn }}</div>
	</div>
	<div class="left-to-learn">
		<div class="left">Umiesz już</div>
		<div class="left-number">{{ learntVerbs }}</div>
	</div>
	<div class="info-box">
		<div class="float-left">Lista poznanych czasowników</div>
		<div class="float-right">Ilość błędów: {{ mistakes }}</div>
		<div class="clearfix"></div>
		<div class="mistakes-stripe"></div>
		<div class="font-weight-bold" v-for="verb in learnedVerbsArray">
			{{verb.verbInInfinitive}} -
			{{verb.verbInPastSimple}} -
			{{verb.verbInPastParticiple}} ⟶
			{{verb.verbInPolish}}
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</div>
<script>
const { createApp } = Vue
createApp({
	data() {
		return {
			i: 0,
			learnedVerbsArray: [],
			learnedVerbsIds: [],
			verbsLeftToLearn: 0,
			learntVerbs: 0,
			mistakes: 0,
			showMistakesBox: true,
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
			},
			allVerbsArray: [],
		}
	},
	methods: {
		goToVerbs() {
			window.location = 'http://localhost/verbs/verb_list'
		},
		drawVerb() {
			console.log(this.allVerbsArray);
			let randomKey = Math.floor(Math.random() * this.allVerbsArray.length);
			console.log(randomKey);
			this.allVerbsArray.splice(randomKey, 1);
			if (this.allVerbsArray.length !== 0) {
				console.log(this.allVerbsArray[1]['verbInPolish'])
				this.x.main = this.allVerbsArray[1]['verbInPolish']
			}
			// this.verbInPolish = this.allVerbsArray[1]
			// if (this.verbsLeftToLearn === 0) {
			// 	this.verbsLeftToLearn = response.data.amountOfVerbs;
			// }
			// if (this.announcement === 'Wszystko ok!') {
			// 	this.verbs.verbInInfinitive = '';
			// 	this.verbs.verbInPolish = '';
			// 	this.verbs.verbInPastSimple = '';
			// 	this.verbs.verbInPastParticiple = '';
			// 	this.announcement = '';
			// }
			// switch (this.x.choosen) {
			// 	case 'verbInInfinitive':
			// 		this.verbs.verbInInfinitive = response.data.verbInInfinitive;
			// 		break;
			// 	case 'verbInPolish':
			// 		this.verbs.verbInPolish = response.data.verbInPolish;
			// 		break;
			// 	case 'verbInPastSimple1':
			// 		this.verbs.verbInPastSimple = response.data.verbInPastSimple1;
			// 		break;
			// 	case 'verbInPastParticiple1':
			// 		this.verbs.verbInPastParticiple = response.data.verbInPastParticiple1;
			// }
			// this.x.main = response.data[this.x.choosen];
		},
		checkTranslation()
		{
			let app = this;
			axios.post('Learning/checkTranslation',
				{verbs: this.verbs, x: this.x}, {
					headers: {
						'Content-Type': 'multipart/form-data',
					}
				})
				.then(function (response) {
					if (response.data) {
						app.announcement = response.data.communicate;
						app.mistakes = app.announcement === 'Błąd!' ? app.mistakes + 1 : app.mistakes;
						app.announcement === 'Wszystko ok!' ? app.addVerbToLearned() : undefined;
						// if (app.announcement === 'Wszystko ok!'){
						// 	app.addVerbToLearned();
						// }
					}

				})
				.catch(function (error) {
					console.log(error);
				});
		},
		verbFormChange(e)
		{
			this.x.choosen = e.srcElement.value
			this.verbInInfinitiveMODE = false;
			this.verbInPolishMODE = false;
			this.verbInPastParticipleMODE = false;
			this.verbInPastSimpleMODE = false;
			this.verbs.verbInPolish = null;
			this.verbs.verbInInfinitive = null;
			this.verbs.verbInPastSimple = null;
			this.verbs.verbInPastParticiple = null;
			switch (this.x.choosen) {
				case 'verbInInfinitive':
					this.verbInInfinitiveMODE = true;
					break;
				case 'verbInPolish':
					this.verbInPolishMODE = true;
					break;
				case 'verbInPastSimple1':
					this.verbInPastSimpleMODE = true;
					break;
				case 'verbInPastParticiple1':
					this.verbInPastParticipleMODE = true;
					break;
				case '5':
					let random = Math.floor(Math.random() * 4) + 1;
					switch (random) {
						case 1:
							this.verbInInfinitiveMODE = true;
							this.x.choosen = 'verbInInfinitive';
							break;
						case 2:
							this.verbInPolishMODE = true;
							this.x.choosen = 'verbInPolish';
							break;
						case 3:
							this.verbInPastSimpleMODE = true;
							this.x.choosen = 'verbInPastSimple1';
							break;
						case 4:
							this.verbInPastParticipleMODE = true;
							this.x.choosen = 'verbInPastParticiple1';
					}
			}
		},
		addVerbToLearned()
		{
			let verb = {
				'verbInPolish': this.verbs.verbInPolish,
				'verbInInfinitive': this.verbs.verbInInfinitive,
				'verbInPastParticiple': this.verbs.verbInPastParticiple,
				'verbInPastSimple': this.verbs.verbInPastSimple
			}
			if (this.learnedVerbsArray[0] === undefined) {
				this.learnedVerbsArray.push(verb);
				delete this.allVerbsArray[this.verbInPolish];
				this.verbsLeftToLearn--;
				this.learntVerbs++;
			}
			if (this.learnedVerbsArray[this.i].verbInPolish !== this.verbs.verbInPolish) {
				this.learnedVerbsArray.push(verb);
				delete this.allVerbsArray[this.verbInPolish];
				this.verbsLeftToLearn--;
				this.learntVerbs++;
				this.i++;
			}
		},

		async allVerbs() {
			let app = this;
			await axios.get('Learning/allVerbs', {
				headers: {
					'Accept': 'application/json'
				}
			})
				.then(function (response) {
					if (response.data) {
						app.allVerbsArray = response.data;
					}
				})
				.catch(function (error) {
					console.log(error);
				});
		}
	},
	created() {
		this.drawVerb();
		this.allVerbs();
	},
	computed: {
	}

}).mount('#app')
</script>

<?php
require_once 'footer.php';
?>
