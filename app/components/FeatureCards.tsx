'use client';

import { useInView } from 'react-intersection-observer';
import Image from 'next/image';

export default function FeatureCards() {
  const [ref, inView] = useInView({
    triggerOnce: true,
    threshold: 0.1,
  });

  return (
    <section className="features" ref={ref}>
      <div className="container">
        <div className={`card-grid animate-on-scroll ${inView ? 'in-view' : ''}`}>
          <a href="#taproom" className="feature-card">
            <Image
              src="/taproom.jpg"
              alt="Visit Our Taproom"
              fill
              style={{ objectFit: 'cover' }}
            />
            <div className="feature-card-content">
              <h2 className="feature-card-title">Visit Our Taproom</h2>
            </div>
          </a>
          <a href="#events" className="feature-card">
            <Image
              src="/events.jpg"
              alt="Upcoming Events"
              fill
              style={{ objectFit: 'cover' }}
            />
            <div className="feature-card-content">
              <h2 className="feature-card-title">Upcoming Events</h2>
            </div>
          </a>
        </div>
      </div>
    </section>
  );
}
