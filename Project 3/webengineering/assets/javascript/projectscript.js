/*navigation images*/
var visitingFreq = new Array;
var activeSince = new Array;
var active = new Array;
var d = new Date();
var maxSize = 50;
var minSize = 30;

var animationLength = 1000;
var animationSlideLeft = "-2000px";
var animationSlideBottom = "-500px";

/*animations*/
var triggered = new Array;

$(document).ready(function() {
  portfoliofilter("ALL");

   d = new Date();
   var currMs = d.getTime();
   for (var i = 0; i < 8; i++) {
       visitingFreq.push(0);
       activeSince.push(currMs);
       active.push(false);
       //  triggered.push(false);
   }
   for (var i = 0; i < 9; i++) {
       triggered.push(false);
   }

   updateNavImageSizes();
   animateSections();

   $(window).scroll(function() {updateNavImageSizes();animateSections();});
});


function portfoliofilter(filter)
{

  var data = {
       'action': 'pffilter',
       'filter': filter
  };

    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    jQuery.post( "wp-admin/admin-ajax.php", data, function(response){
      document.getElementById("contentlist").innerHTML = response;
      // alert('Got this from the server: ' + response);
    });

}

function animateSections()
{
   if (scrolledIntoView('#home') && !triggered[0]) {
       triggered[0] = true;
       animateHome();
   }
   if (scrolledIntoView('#about') && !triggered[1]) {
       triggered[1] = true;
       animateAbout();
   }
   if (scrolledIntoView('#partDesigner') && !triggered[2]) {
       triggered[2] = true;
       animatePartDesigner();
   }
   if (scrolledIntoView('#partCoder') && !triggered[3]) {
       triggered[3] = true;
       animatePartCoder();
   }
   if(scrolledIntoView('#technicalSkills') && !triggered[4]) {
       triggered[4] = true;
       animateTechnicalSkills();
   }
   if(scrolledIntoView('#portfolio') && !triggered[5]) {
       triggered[5] = true;
       animatePortfolio();
   }
   if(scrolledIntoView('#blog') && !triggered[6]) {
       triggered[6] = true;
       animateBlog();
   }
   if(scrolledIntoView('#crafted') && !triggered[7]) {
       triggered[7] = true;
       animateCrafted();
   }
   if(scrolledIntoView('#contact') && !triggered[8]) {
       triggered[8] = true;
       animateContact();
   }
}

function animateHome()
{
   document.getElementById('home').getElementsByTagName('p')[0].style.left = animationSlideLeft;
   //document.getElementById('home').getElementsByTagName('p')[1].style.left = animationSlideLeft;

   jQuery("#home p").animate({
       left: "0",
   }, animationLength);
}

function animateAbout() {
   document.getElementById('about').getElementsByTagName('header')[0].style.left = animationSlideLeft;
   document.getElementById('about').getElementsByTagName('p')[0].style.left = animationSlideLeft;
   //document.getElementById('about').getElementsByTagName('p')[1].style.left = animationSlideLeft;

   $("#about header").animate({
       left: "0",
   }, animationLength);

   $("#about p").animate({
       left: "0",
   }, animationLength);
}

function animatePartDesigner() {
   document.getElementById('partDesigner').getElementsByTagName('h1')[0].style.bottom = animationSlideBottom;
   document.getElementById('partDesigner').getElementsByTagName('p')[0].style.bottom = animationSlideBottom;

   $("#partDesigner h1").animate({
       bottom: "0",
   }, animationLength);

   $("#partDesigner p").animate({
       bottom: "0",
   }, animationLength);
}

function animatePartCoder() {
   document.getElementById('partCoder').getElementsByTagName('h1')[0].style.left = animationSlideLeft;
   document.getElementById('partCoder').getElementsByTagName('p')[0].style.left = animationSlideLeft;

   $("#partCoder h1").animate({
       left: "0",
   }, animationLength);

   $("#partCoder p").animate({
       left: "0",
   }, animationLength);
}

function animateTechnicalSkills() {
   document.getElementById('technicalSkills').getElementsByTagName('h1')[0].style.bottom = animationSlideBottom;
   document.getElementById('technicalSkills').getElementsByTagName('ul')[0].style.bottom = animationSlideBottom;

   $("#technicalSkills h1").animate({
       bottom: "0",
   }, animationLength);

   $("#technicalSkills ul").animate({
       bottom: "0",
   }, animationLength);
}

function animatePortfolio() {
   document.getElementById('portfolio').style.left = animationSlideLeft;

   $("#portfolio").animate({
       left: "0",
   }, animationLength);
}

function animateBlog() {
   document.getElementById('blog').getElementsByClassName('block')[0].style.left = animationSlideLeft;
   document.getElementById('blog').getElementsByClassName('block')[1].style.left = animationSlideLeft;
   document.getElementById('blog').getElementsByClassName('right')[0].style.bottom = animationSlideBottom;

   $("#blog .block").animate({
       left: "0",
   }, animationLength);

   $("#blog .right").animate({
       bottom: "0",
   }, animationLength);
}

function animateCrafted() {
   document.getElementById('crafted').getElementsByTagName('h1')[0].style.left = animationSlideLeft;
   document.getElementById('crafted').getElementsByTagName('p')[0].style.left = animationSlideLeft;
   document.getElementById('crafted').getElementsByTagName('p')[1].style.left = animationSlideLeft;

   $("#crafted h1").animate({
       left: "0",
   }, animationLength);

   $("#crafted p").animate({
       left: "0",
   }, animationLength);
}

function animateContact() {
   document.getElementById('contact').getElementsByClassName('container')[0].style.left = animationSlideLeft;

   $("#contact .container").animate({
       left: "0",
   }, animationLength);


}

function updateNavImageSizes()
{
   d = new Date();
   if (isInMiddleOfViewport('#home') && !active[0]) {
       activeSince[0] = d.getTime();
       setActive(0);
       setTimeout(function(){ updateButtonSizes(0); }, 2000);
   }
   else if(isInMiddleOfViewport('#about') && !active[1])
   {
       activeSince[1] = d.getTime();
       setActive(1);
       setTimeout(function(){ updateButtonSizes(1); }, 2000);
   }
   else if (isInMiddleOfViewport('#portfolio') && !active[2]) {
       activeSince[2] = d.getTime();
       setActive(2);
       setTimeout(function(){ updateButtonSizes(2); }, 2000);
   }
   else if (isInMiddleOfViewport('#blog') && !active[3]) {
       activeSince[3] = d.getTime();
       setActive(3);
       setTimeout(function(){ updateButtonSizes(3); }, 2000);
   }
   else if (isInMiddleOfViewport('#contact') && !active[4]) {
       activeSince[4] = d.getTime();
       setActive(4);
       setTimeout(function(){ updateButtonSizes(4); }, 2000);
   }
   else if (isInMiddleOfViewport('#technicalSkills') && !active[1]) {
       activeSince[1] = d.getTime();
       setActive(1);
       setTimeout(function(){ updateButtonSizes(1); }, 2000);
   }
   else if (isInMiddleOfViewport('#partCoder') && !active[1]) {
       activeSince[1] = d.getTime();
       setActive(1);
       setTimeout(function(){ updateButtonSizes(1); }, 2000);
   }
   else if (isInMiddleOfViewport('#partDesigner') && !active[1]) {
       activeSince[1] = d.getTime();
       setActive(1);
       setTimeout(function(){ updateButtonSizes(1); }, 2000);
   }
}

function setActive(activate) {
   for (var i = 0; i < 5; i++) {
       active[i] = false;
   }
   active[activate] = true;
}
function isInMiddleOfViewport(elem)
{
   var $elem = $(elem);
   var $window = $(window);

   var viewTop = $window.scrollTop();
   var viewBottom = viewTop + $window.height();

   var elemTop = $elem.offset().top;
   var elemBottom = elemTop + $elem.height();

   return ((viewTop+viewBottom)/2 < elemBottom &&  (viewTop+viewBottom)/2 > elemTop);
}
function scrolledIntoView(elem)
{
   var $elem = $(elem);
   var $window = $(window);

   var viewTop = $window.scrollTop();
   var viewBottom = viewTop + $window.height();

   var elemTop = $elem.offset().top;
   var elemBottom = elemTop + $elem.height();

   return (elemTop <= viewBottom);
}
function updateButtonSizes(buttonNr)
{
   d = new Date();
   if(d.getTime()-activeSince[buttonNr] >= 2000 && active[buttonNr]){
       visitingFreq[buttonNr] = visitingFreq[buttonNr]+ 1;
   }

   var maxFreq = 0;
   for (var i = 0; i < 5; i++) {
       if(visitingFreq[i] > maxFreq) {
           maxFreq = visitingFreq[i];
       }
   }
   var newSize = (visitingFreq[0]/ maxFreq)*(maxSize-minSize)+minSize;
   $('#homeImg').css({'height': newSize, 'width': newSize});
   newSize = (visitingFreq[1]/ maxFreq)*(maxSize-minSize)+minSize;
   $('#aboutImg').css({'height': newSize, 'width': newSize});
   newSize = (visitingFreq[2]/ maxFreq)*(maxSize-minSize)+minSize;
   $('#portfolioImg').css({'height': newSize, 'width': newSize});
   newSize = (visitingFreq[3]/ maxFreq)*(maxSize-minSize)+minSize;
   $('#blogImg').css({'height': newSize, 'width': newSize});
   newSize = (visitingFreq[4]/ maxFreq)*(maxSize-minSize)+minSize;
   $('#contactImg').css({'height': newSize, 'width': newSize});
}
