'use client';

import { useState } from 'react';
import Link from 'next/link';

export default function Header() {
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  return (
    <header className="site-header">
      <div className="container header-container">
        <div className="site-branding">
          <Link href="/">
            <img src="/logo.png" alt="Little Miami Brewing Company" />
          </Link>
        </div>

        <nav className={`main-navigation ${isMenuOpen ? 'toggled' : ''}`}>
          <button
            className="menu-toggle"
            aria-controls="primary-menu"
            aria-expanded={isMenuOpen}
            onClick={() => setIsMenuOpen(!isMenuOpen)}
          >
            <span className="screen-reader-text">Menu</span>
            <span className="menu-toggle-icon"></span>
          </button>

          <ul id="primary-menu">
            <li><Link href="#about">About</Link></li>
            <li><Link href="#our-beers">Our Beers</Link></li>
            <li><Link href="#events">Events</Link></li>
            <li><Link href="#contact">Contact</Link></li>
          </ul>

          <div className="social-icons">
            <a href="#" className="social-icon"><i className="fab fa-facebook-f"></i></a>
            <a href="#" className="social-icon"><i className="fab fa-instagram"></i></a>
            <a href="#" className="social-icon"><i className="fab fa-twitter"></i></a>
          </div>
        </nav>
      </div>
    </header>
  );
}
