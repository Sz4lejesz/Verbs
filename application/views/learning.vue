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
	<div class="randomized-verb" v-if="verbInPolishMODE">{{ x.drawnVerb }}</div>
	<div class="randomized-verb" v-if="verbInInfinitiveMODE">{{ x.drawnVerb }}</div>
	<div class="randomized-verb" v-if="verbInPastSimpleMODE">{{ x.drawnVerb }}</div>
	<div class="randomized-verb" v-if="verbInPastParticipleMODE">{{ x.drawnVerb }}</div>
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
		<label class="toggle float-right">
			<input class="toggle-checkbox" type="checkbox" @click="showMistakesBox = !showMistakesBox">
			<div class="toggle-switch"></div>
		</label>
		<div class="div" v-if="showMistakesBox">
			<div class="z-index-5 float-left text">Po ilu poprawnych odpowiedziach przestać powtarzać dany czasownik na liście do nauki?
			</div>
			<input v-model="repeatNeededTimes" min="1" class="float-left number-input">
		</div>
		<div class="clearfix"></div>
		<div class="learning-stripe"></div>
		<div class="learning-row">Używać pełnej listy czasowników?</div>
		<label class="toggle float-right">
			<input class="toggle-checkbox" type="checkbox">
			<div class="toggle-switch"></div>
		</label>
		<div class="clearfix"></div>
		<div class="learning-stripe"></div>
		<div class="apply-settings float-right" @click="settingsPopUp = false, drawVerb(), onlyNumbers()" >Zastosuj</div>
	</div>
	<div class="clearfix"></div>
	<div class="learning-stripe"></div>
	<div class="check-button" @click="checkTranslation()" >🤔&nbspSprawdź</div>
	<div class="learning-button" @click="learningPopUp = !learningPopUp">🤓&nbspNauka</div>
	<div class="learning-button" @click="drawVerb()">🙀&nbspNowy</div>
	<div class="add-to-group-button">✔️&nbspDodaj do grupy</div>
	<div class="clearfix"></div>
	<div class="learning-announcement" >{{ announcement }}</div>
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
		<div class="left-number">{{ allVerbsArray.length }}</div>
	</div>
	<div class="left-to-learn">
		<div class="left">Umiesz już</div>
		<div class="left-number">{{ learnedVerbs }}</div>
	</div>
	<div class="info-box">
		<div class="float-left">Lista poznanych czasowników</div>
		<div class="float-right">Ilość błędów: {{ mistakes }}</div>
		<div class="clearfix"></div>
		<div class="mistakes-stripe"></div>
		<div class="font-weight-bold" v-for="verb in learnedVerbsArray">
			<div v-if="showVerb(verb)">
			{{verb.verbInInfinitive}} -
			{{verb.verbInPastSimple}} -
			{{verb.verbInPastParticiple}} ⟶
			{{verb.verbInPolish}}
			</div>
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
			repeatNeededTimes: 1,
			learnedVerbsArray: [],
			allRight: 1,
			learnedVerbs: 0,
			randomId: null,
			mistakes: 0,
			showMistakesBox: false,
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
				drawnVerb: null,
				verbForm: 'verbInPolish'
			},
			allVerbsArray: [],
		}
	},
	methods: {
		showVerb(verb) {
			return parseInt(verb.passedTests) === parseInt(this.repeatNeededTimes);
		},
		onlyNumbers() {
		this.repeatNeededTimes = this.repeatNeededTimes.replace(/[^0-9]/g,'')
		},
		goToVerbs() {
			window.location = 'http://localhost/verbs/verb_list'
		},
		drawVerb() {
			// console.log(this.learnedVerbsArray)
			this.randomId = Math.floor(Math.random() * this.allVerbsArray.length);
			this.verbInPolish = this.allVerbsArray[this.randomId]['verbInPolish'];
			this.verbInInfinitive = this.allVerbsArray[this.randomId]['verbInInfinitive'];
			this.verbInPastParticiple = this.allVerbsArray[this.randomId]['verbInPastParticiple1'];
			this.verbInPastSimple = this.allVerbsArray[this.randomId]['verbInPastSimple1'];
			this.x.drawnVerb = this.allVerbsArray[this.randomId]['verbInPolish'];
			if (this.announcement === 'Wszystko ok!') {
				this.verbs.verbInInfinitive = '';
				this.verbs.verbInPolish = '';
				this.verbs.verbInPastSimple = '';
				this.verbs.verbInPastParticiple = '';
				this.announcement = '';
			}
			switch (this.x.verbForm) {
				case 'verbInInfinitive':
					this.verbs.verbInInfinitive = this.allVerbsArray[this.randomId]['verbInInfinitive'];
					this.x.drawnVerb = this.allVerbsArray[this.randomId]['verbInInfinitive'];
					break;
				case 'verbInPolish':
					this.verbs.verbInPolish = this.allVerbsArray[this.randomId]['verbInPolish'];
					this.x.drawnVerb = this.allVerbsArray[this.randomId]['verbInPolish'];
					break;
				case 'verbInPastSimple1':
					this.verbs.verbInPastSimple = this.allVerbsArray[this.randomId]['verbInPastSimple1'];
					this.x.drawnVerb = this.allVerbsArray[this.randomId]['verbInPastSimple1'];
					break;
				case 'verbInPastParticiple1':
					this.verbs.verbInPastParticiple = this.allVerbsArray[this.randomId]['verbInPastParticiple1'];
					this.x.drawnVerb = this.allVerbsArray[this.randomId]['verbInPastParticiple1'];
			}
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
						let flag = true;
						app.allRight = response.data.allRight;
						if (app.allRight) {
							if (app.repeatNeededTimes === 1) {
								app.addVerbToLearned();
								app.allVerbsArray.splice(this.randomId, 1);
								app.learnedVerbs++;
							} else {
								if (!app.isVerbAdded(app.x.drawnVerb)) {
									app.addVerbToLearned();
								} else {
									app.isVerbAddedXTimes(app.repeatNeededTimes, app.x.drawnVerb);
								}
							}
						} else {
							app.mistakes++;
						}
					}
				})
				.catch(function (error) {
					console.log(error);
				});
		},
		isVerbAddedXTimes(times, verb)
		{
			for (let i = 0 ; i < this.learnedVerbsArray.length; i++) {
				if (this.learnedVerbsArray[i].passedTests < times) {
					if (this.learnedVerbsArray[i].verbInPolish === verb) {
						this.learnedVerbsArray[i].passedTests++;
					}
				}
			}
			this.allVerbsArray.splice(this.randomId, 1);
			this.learnedVerbs++;
		},
		isVerbAdded(verb)
		{
			for (let i = 0 ; i < this.learnedVerbsArray.length; i++) {
				if (this.learnedVerbsArray[i].verbInPolish === verb) {
					return true;
				}
			}
			return false;
		},
		addVerbToLearned()
		{
			let verb = {
				'verbInPolish': this.verbs.verbInPolish,
				'verbInInfinitive': this.verbs.verbInInfinitive,
				'verbInPastParticiple': this.verbs.verbInPastParticiple,
				'verbInPastSimple': this.verbs.verbInPastSimple,
				'id': this.allVerbsArray[this.randomId]['id'],
				'passedTests': 1,
				'mistakesMade': 0
			}
			this.learnedVerbsArray.push(verb);
		},
		async allVerbs() {
			let app = this;
			try {
				let response = await axios.get('Learning/allVerbs', {
					headers: {
						'Accept': 'application/json'
					}
				})
				if (response.data) {
					this.allVerbsArray = response.data;
					this.drawVerb()
				}
			} catch (error) {
				console.log(error)
			}
		},
	},
	verbFormChange(e)
	{
		this.x.verbForm = e.srcElement.value
		this.verbInInfinitiveMODE = false;
		this.verbInPolishMODE = false;
		this.verbInPastParticipleMODE = false;
		this.verbInPastSimpleMODE = false;
		this.verbs.verbInPolish = null;
		this.verbs.verbInInfinitive = null;
		this.verbs.verbInPastSimple = null;
		this.verbs.verbInPastParticiple = null;
		switch (this.x.verbForm) {
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
						this.x.verbForm = 'verbInInfinitive';
						break;
					case 2:
						this.verbInPolishMODE = true;
						this.x.verbForm = 'verbInPolish';
						break;
					case 3:
						this.verbInPastSimpleMODE = true;
						this.x.verbForm = 'verbInPastSimple1';
						break;
					case 4:
						this.verbInPastParticipleMODE = true;
						this.x.verbForm = 'verbInPastParticiple1';
				}
		}
	},
	created() {
		this.allVerbs();
	},
	computed: {
	}

}).mount('#app')
</script>

<?php
require_once 'footer.php';
?>
