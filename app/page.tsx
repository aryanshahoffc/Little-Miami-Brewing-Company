'use client';

import { useEffect } from 'react';
import { useInView } from 'react-intersection-observer';
import Header from '../components/Header';
import Hero from '../components/Hero';
import FeatureCards from '../components/FeatureCards';
import VideoSection from '../components/VideoSection';
import Reviews from '../components/Reviews';
import Footer from '../components/Footer';

export default function Home() {
  const [heroRef, heroInView] = useInView({
    triggerOnce: true,
    threshold: 0.1,
  });

  useEffect(() => {
    // Handle scroll for header background
    const header = document.querySelector('.site-header');
    const handleScroll = () => {
      if (window.scrollY > 100) {
        header?.classList.add('scrolled');
      } else {
        header?.classList.remove('scrolled');
      }
    };

    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <main>
      <Header />
      
      <div ref={heroRef} className={`animate-on-scroll ${heroInView ? 'in-view' : ''}`}>
        <Hero />
      </div>      <FeatureCards />
      <VideoSection />
      <Reviews />
      <Footer />
    </main>
  );
}
