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
		<div class="randomized-verb">Robić</div>
		<img src="content/images/settings.png" height="21" width="21" class="settings" @click="addVerbPopUp = true"/>
		<div class="clearfix"></div>
		<div class="learning-stripe"></div>
		<div class="learning-inputs-box">
			<div class="learning-infinitive-z-index">Infitive</div>
			<input type="text" class="learning-infinitive-input" v-model="Infinitive">
			<div class="learning-past-simple-z-index">Past Simple</div>
			<input type="text" class="learning-past-simple-input" v-model="Infinitive">
			<div class="learning-past-participle-z-index">Past Participle</div>
			<input type="text" class="learning-infinitive-input" v-model="Infinitive">
		</div>
		<div class="clearfix"></div>
		<div class="learning-stripe"></div>
		<img src="content/images/check.png" height="16" width="19" class="check-image"/>
		<div class="check-button">&nbsp&nbsp&nbsp&nbsp&nbspSprawdź</div>
		<img src="content/images/learning.png" height="19" width="23" class="learning-image"/>
		<div class="learning-button">&nbsp&nbsp&nbsp&nbspNauka</div>
		<img src="content/images/new.png" height="19" width="20" class="new-image"/>
		<div class="learning-button">&nbsp&nbsp&nbsp&nbspNowy</div>
		<img src="content/images/add-to-group.png" height="17" width="17" class="add-to-group-image"/>
		<div class="add-to-group-button">&nbsp&nbsp&nbsp&nbsp&nbspDodaj do grupy</div>
		<div class="overlay" v-if="addVerbPopUp"></div>
		<div class="clearfix"></div>
		<div class="add-verb" v-if="addVerbPopUp">
		DODATKOWE USTAWIENIA
		<img src="content/images/cross.png" height="22" width="20" @click="addVerbPopUp = false" class="close-button"/>
		</div>
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
				verbInInfinitive: '',
				verbInPastSimple: '',
				verbInPastParticiple1: ''
			},
		}
	},
	methods: {
		saveVerb() {
			let app = this;
			axios.post('Learning/saveVerbs',
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
		goToVerbs()
		{
			window.location = 'http://localhost/verbs/verb_list'
		},
		showVerbs()
		{
			let app = this;
			axios.post('Learning/showVerbs',

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
