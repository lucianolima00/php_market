import React, {ChangeEvent, FormEvent, useEffect, useRef, useState} from "react";
import './style.css';

import phone1 from '../../assets/iphone-portifolio-1.png';
import phone2 from '../../assets/iphone-portifolio-2.png';
import phone3 from '../../assets/iphone-portifolio-3.png';
import behanceWhite from '../../assets/behance-white.png'
import githubWhite from '../../assets/github-white.png'
import linkedinWhite from '../../assets/linkedin-white.png'
import instaWhite from '../../assets/insta-logo-white.png'
import behanceBlack from '../../assets/behance.png'
import githubBlack from '../../assets/github.png'
import linkedinBlack from '../../assets/linkedin.png'
import instaBlack from '../../assets/insta-logo.png'
import backButton from '../../assets/back-button.png'
import forwardButton from '../../assets/forward-button.png'
import sendButton from '../../assets/send-button.png'

// @ts-ignore

const Landing = () => {

    return (
        <div id='page-landing'>
            <div id="background-middle">
            </div>
            <div className='container'>

                {/* LANDING */}

                <div id="portfolio-phone-1">
                    <img src={phone1} alt=""/>
                </div>

                <div id="social-background"/>
                <div id="white-social-links">
                    <a href="https://github.com/lucianolima00" target="_blank" rel="noreferrer"
                       className="social-link">
                        <img src={githubWhite} alt=""/>
                    </a>
                    <a href="https://www.behance.net/lucianolima00" target="_blank" rel="noreferrer"
                       className="social-link">
                        <img src={behanceWhite} alt=""/>
                    </a>
                    <a href="https://www.linkedin.com/in/lucianolima00" target="_blank" rel="noreferrer"
                       className="social-link">
                        <img src={linkedinWhite} alt=""/>
                    </a>
                    <a href="https://www.instagram.com/luciano.lima00" target="_blank" rel="noreferrer"
                       className="social-link">
                        <img src={instaWhite} alt=""/>
                    </a>
                </div>
            </div>
        </div>
    );
}

export default Landing;