
require([
        "dojo/_base/declare",
        "dojo/dom",
        "dojo/query",
        "dojo/dom-class",
        "dojo/_base/array",
        "dojo/on",
        "dojo/ready",
        "dojo/NodeList-dom"
    ], function(declare, dom, query, domClass, array, on, ready) {


      // Private vars
      var _highFive = {};

      // Public var
      var animatronics = {};

      animatronics.HighFive = declare([], {
        // Need SVG element ID where to load the animation
        constructor: function(elId){
          this.elId = elId;
          this.s = Snap('#' + this.elId);
          this.bgCircle = {};
          this.svgDOM = null;
          this.svgs = {};
          this.timesClicked = 0;

          // mask
          this.bgCircle.mask = this.s.circle(200, 200, 200);
          this.bgCircle.mask.attr({
            fill:"#FFFFFF",
            stroke:"#000000",
            strokeWidth:0
          });

          // background
          this.bgCircle.bg = this.s.circle(200, 200, 200);
          this.bgCircle.bg.attr({fill:"#97D2C4"});

          Snap.load("https://s3-us-west-2.amazonaws.com/s.cdpn.io/150883/high-five-all.svg", this.loadAndInit);

          _highFive = this;

        }, //eo Constructor

        loadAndInit: function(f){
          _highFive.svgDOM = f;

          // Hand 1
          _highFive.svgs._01 = _highFive.svgDOM.select("#high-five-01");
          // Hand 2
          _highFive.svgs._02 = _highFive.svgDOM.select("#high-five-02");
          // Hand 3
          _highFive.svgs._03 = _highFive.svgDOM.select("#high-five-03");
          _highFive.svgs._03.palm =  _highFive.svgDOM.select("#palm");
          _highFive.svgs._03.fingerprintsGrp =  _highFive.svgDOM.select("#fingerprints");
          // Collect all fingerprints from the hand
          _highFive.svgs._03.fingerprints = _highFive.svgDOM.selectAll("#fingerprints > *");

          // Order of grouping is important!!!
          var gr01 = _highFive.s.group(_highFive.bgCircle.bg, _highFive.svgs._01, _highFive.svgs._02, _highFive.svgs._03);
          gr01.attr({mask:_highFive.bgCircle.mask});

          // Add to SVG tag
          _highFive.s.add(_highFive.svgDOM);

          // Then initialize position. Prevents NS_ERROR_FAILURE in FF
          _highFive.svgs._01.initStr = "s0.6r-30t-100,280";
          _highFive.svgs._01.transform(_highFive.svgs._01.initStr);

          _highFive.svgs._02.initStr = "t-50,25";
          _highFive.svgs._02.attr({opacity:0});
          _highFive.svgs._02.transform(_highFive.svgs._02.initStr);

          _highFive.svgs._03.initStr = "t-50,30";
          _highFive.svgs._03.attr({opacity:0});
          _highFive.svgs._03.transform(_highFive.svgs._03.initStr);

          query("#fingertips > ellipse").addClass("fingertip");

          // Wire Events
          _highFive.setUpEvents();

          // Start animation
          _highFive.animate01();
        },

        animate01: function(){
          /* wait 1/2 second to start animating */
          setTimeout(function(){
            _highFive.svgs._01.animate({transform:'t-50,60'}, 400, mina.backout, function() { //400ms
              setTimeout(function(){
                _highFive.svgs._01.animate({opacity:0}, 30, mina.linear, function(){
                  _highFive.svgs._01.attr({display:'none'});
                  _highFive.animate02();
                });
              }, 100);
            });
          }, 500);
        },

        animate02: function() {
          _highFive.svgs._02.animate({opacity: 1}, 10, mina.linear, function () {
            _highFive.svgs._02.animate({opacity: 0}, 30, mina.linear, function () {
              _highFive.svgs._02.attr({display: 'none'});
            });
          });

          _highFive.animate03();
        },

        animate03:function(){
          _highFive.svgs._03.animate({opacity:1}, 30, mina.linear, function(){

            //Flickr of screen
            _highFive.bgCircle.bg.animate({fill:"#FFFFFF"}, 10, mina.linear, function(){
              _highFive.bgCircle.bg.animate({fill:"#97D2C4"}, 10);
            });

            _highFive.svgs._03.animate({transform:"s1.05t-50,0"}, 600, mina.elastic, function(){ //600ms
              _highFive.svgs._03.animate({transform:"t-50,5"}, 1000, mina.elastic); //1000ms
              _highFive.svgs._03.fingerprintsGrp.animate({opacity:0}, 500);
            });

          });
        },

        setUpEvents: function(){
          var container = query("#"+_highFive.elId);
          container.on("click", function(){
            if(!_highFive.s.attr("class")){ _highFive.s.attr({'class':'clicked'}); }

            if(_highFive.timesClicked < 5){
              _highFive.resetHighFive();
              _highFive.animate01();
              _highFive.makeRed();
            }
          });
        },

        resetHighFive: function(){
          // Init attr svg01
          _highFive.svgs._01.attr({display:'block'});
          _highFive.svgs._01.transform(_highFive.svgs._01.initStr);
          _highFive.svgs._01.attr({opacity:1});

          // Init attr svg02
          _highFive.svgs._02.attr({display:'block'});
          _highFive.svgs._02.transform(_highFive.svgs._02.initStr);

          // Init attr svg03
          _highFive.svgs._03.attr({opacity:0});
          _highFive.svgs._03.fingerprintsGrp.attr({opacity:1});

          /* If animation for fingerprints going, stop it!!! */
          if(_highFive.svgs._03.fingerprintsGrp.inAnim()[0]){
            var animObj = _highFive.svgs._03.fingerprintsGrp.inAnim()[0];
            animObj.stop();
          }

          _highFive.svgs._03.transform(_highFive.svgs._03.initStr);
        },

        makeRed: function(){

          var shadesRed = ["#C3B49B", "#CCB59E", "#D8B5A3", "#E6B6A7", "#F3B7AC"];
          var shadesRedFingertips = ["#CCB59E", "#D8B5A3", "#E6B6A7", "#F3B7AC", "#D3978C"];

          _highFive.svgs._03.palm.animate({fill:shadesRed[_highFive.timesClicked]},600,mina.easein);
          var fingerPrints = _highFive.svgs._03.fingerprints;
          array.forEach(fingerPrints, function(entry, i){
            entry.animate({fill:shadesRedFingertips[_highFive.timesClicked]},600,mina.easein);
          });

          _highFive.timesClicked++;
        }

      });


      ready(function(){
        new animatronics.HighFive('high-five');
    });

    });
