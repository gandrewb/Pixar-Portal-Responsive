(function(){
	
//Menu Button Logic	
var menu_btn = document.getElementById('menu_btn'),
	frame = document.getElementById('frame');

menu_btn.addEventListener('click', function(e){
	frame.classList.toggle('show_sidebar');
});


//Setting Width of Poster Container
var poster_container = document.getElementById('poster_container'),
	posters = poster_container.querySelectorAll('.movie_poster'),
	poster_margin = 22;
	
poster_container.style.width = (posters.length * (100 + poster_margin)) + 'px';


//Wrapping videos with <div class="video"> for scaling
var videos = frame.querySelectorAll("iframe[src*='player.vimeo.com'], iframe[src*='youtube.com'], iframe[src*='youtube-nocookie.com'], iframe[src*='kickstarter.com'][src*='video.html'], object, embed");
	
for(var i=0, l=videos.length; i<l; i++){
	var vid = videos[i],
		parent = vid.parentNode,
		sibling = vid.nextSibling,
		div = document.createElement('div');
		
	div.classList.add('video');
	div.appendChild(vid);
	
	if(sibling){
		parent.insertBefore(div, sibling);
	}else{
		parent.appendChild(div);
	}
}


//Setting Coutdown Timers
var timers = document.querySelectorAll('.timer');
var t_list = [];

for (var i=0, l=timers.length; i<l; i++){
	t_list.push( new Countdown(timers[i]) );
}

function timeCycle(){
	for (var i=0, l=timers.length; i<l; i++){
		t_list[i].updateTime();
	}
	setTimeout(timeCycle, 1000);
};
timeCycle();

})();


//Countdown Feature
function Countdown(el) {
	var t = el.getAttribute("data-time").split(":");
	
	this.el = el;
	this.event_time = new Date(t[0], t[1], t[2], t[3], t[4]);
	
	var ms = {
		day:  86400000,
		hour: 3600000,
		min:  60000,
		sec:  1000
	};
	
	this.calcTime = function(evt) {
		var now = new Date();
		var r = {
			day:  0,
			hour: 0,
			min:  0,
			sec:  0
		};
		
		if (now < evt) {			
			var milis = evt - now;
			
			for (unit in r) {
				r[unit] = Math.floor(milis / ms[unit]);
				milis -= (r[unit] * ms[unit]);
			}
			
			return ((r.day > 0) ? r.day+'d ' : '') + this.zeroCheck(r.hour) + ':' + this.zeroCheck(r.min) + ':' + this.zeroCheck(r.sec);
		} 
		
		else {
			return "00:00:00";
		}
	}
	
	this.updateTime = function(){
		this.el.innerHTML = this.calcTime(this.event_time);
	}
	
	this.zeroCheck = function(num){
		if (num < 10) {
			return "0" + num;
		}	
		return num;
	}
}
