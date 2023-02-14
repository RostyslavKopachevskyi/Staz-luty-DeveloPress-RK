import ScrollTrigger from 'gsap/ScrollTrigger';
import SplitText from 'gsap/SplitText';
import gsap from 'gsap';

/*
add animations using the library GSAP
for more information, read the documentation https://greensock.com/docs/
*/
class GsapAnimations {
	sections = gsap.utils.toArray( '.scroll-animation' );

	constructor() {
		gsap.registerPlugin( ScrollTrigger, SplitText );

		this.runAnimations();
	}

	runAnimations() {
		this.leftAnimation();
		this.opacityAnimation();
		this.staggerAnimation();
		this.scaleAnimation();
		this.splitTextAnimation();
	}

	// start animations
	animations( element, fromConfig, triggerConfig ) {
		this.sections.forEach( ( section ) => {
			let elem = gsap.utils.toArray( element, section );
			gsap.timeline({
				scrollTrigger: {
					once: true,
					trigger: section,
					start: 'top 60%',
					end: '+=500',

					// markers: true,

					...triggerConfig
				}
			})
				.from( elem, fromConfig );
		});
	}

	/*
	the appearance of the element on the right side with a bouncing effect
	to add this animation you need to add a class "scroll-animation--left" to the element
	*/

	leftAnimation() {
		const fromConfig = {
			xPercent: -120,
			opacity: 0,
			ease: 'bounce',
			duration: 2,
		};

		if ( document.querySelector( '.scroll-animation--left' ) ) { //checking if an element exists
			this.animations( '.scroll-animation--left', fromConfig );
		}
	}

	/*
	increasing the element
	to add this animation you need to add a class "scroll-animation--scale" to the element
	*/
	scaleAnimation() {
		const fromConfig = {
			scale: 0.5,
		};
		if ( document.querySelector( '.scroll-animation--scale' ) ) { //checking if an element exists
			this.animations( '.scroll-animation--scale', fromConfig );
		}
	}

	/*
	 the appearance of an element while scrolling
	 to add this animation you need to add a class "scroll-animation--opacity" to the element
	 */
	opacityAnimation() {
		const triggerConfig = {
			scrub: 1,
		};
		const fromConfig = {
			opacity: 0,
		};
		if ( document.querySelector( '.scroll-animation--opacity' ) ) { //checking if an element exists
			this.animations( '.scroll-animation--opacity', fromConfig, triggerConfig );
		}
	}

	/*
	 the appearance of an element with a stagger effect
	 to add this animation you need to add a class "scroll-animation--stagger-item" to all elements in one <div>,
	 and add a class "scroll-animation--stagger" to this <div>
 	*/
	staggerAnimation() {
		const fromConfig = {
			y: 160,
			stagger: 0.1,
			duration: 0.8,
			easy: 'back',
		};
		if ( document.querySelector( '.scroll-animation--stagger' ) && document.querySelector( '.scroll-animation--stagger-item' ) ) { //checking if an elements exists
			this.animations( '.scroll-animation--stagger .scroll-animation--stagger-item', fromConfig );
		}
	}

	/*
	 splitting text in <div> on a line, and appearing while scrolling
	 to add this animation you need to add a class "scroll-animation--split-text" to the element
	 */
	splitTextAnimation() {
		this.sections.forEach( ( section ) => {
			if ( document.querySelector( '.scroll-animation--split-text' ) ) { //checking if an element exists
				let splitText = gsap.utils.toArray( '.scroll-animation--split-text', section );
				let splitTextLines = new SplitText( splitText, {type: 'lines'});
				splitTextLines.lines.forEach( ( line ) => {
					gsap.timeline({
						scrollTrigger: {
							once: true,
							trigger: line,
							start: 'top 75%',
							end: 'bottom 75%',
							scrub: 0.5,

							// markers: true,
						}
					})
						.from( line, {
							y: 100,
							opacity: '0',
							ease: 'none',
						});
				});
			}
		});
	}
}

new GsapAnimations();
