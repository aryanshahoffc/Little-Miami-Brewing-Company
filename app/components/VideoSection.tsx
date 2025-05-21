'use client';

import { useInView } from 'react-intersection-observer';

export default function VideoSection() {
  const [ref, inView] = useInView({
    triggerOnce: true,
    threshold: 0.1,
  });

  return (
    <section className="video-section" ref={ref}>
      <div className="container">
        <div className={`video-grid animate-on-scroll ${inView ? 'in-view' : ''}`}>
          <div className="video-item">
            <div className="video-wrapper">
              <iframe
                src="https://www.youtube.com/embed/your-taproom-video-id"
                title="Taproom & Pizza Kitchen"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowFullScreen
              ></iframe>
            </div>
            <h3>Taproom & Pizza Kitchen</h3>
          </div>
          <div className="video-item">
            <div className="video-wrapper">
              <iframe
                src="https://www.youtube.com/embed/your-elegance-video-id"
                title="Industrial Elegance"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowFullScreen
              ></iframe>
            </div>
            <h3>Industrial Elegance</h3>
          </div>
        </div>
      </div>
    </section>
  );
}
