'use client';

import { useInView } from 'react-intersection-observer';
import { useState, useEffect } from 'react';

interface Review {
  id: string;
  author: string;
  content: string;
  rating: number;
  date: string;
}

export default function Reviews() {
  const [ref, inView] = useInView({
    triggerOnce: true,
    threshold: 0.1,
  });

  const [reviews, setReviews] = useState<Review[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // In a real application, this would fetch from your WordPress API endpoint
    const fetchReviews = async () => {
      try {
        const response = await fetch('/api/reviews');
        const data = await response.json();
        setReviews(data);
      } catch (error) {
        console.error('Error fetching reviews:', error);
      } finally {
        setLoading(false);
      }
    };

    fetchReviews();
  }, []);

  if (loading) {
    return (
      <section className="testimonials" ref={ref}>
        <div className="container">
          <h2>What Our Customers Say</h2>
          <div className="testimonials-grid">
            <div className="testimonial-loading">Loading reviews...</div>
          </div>
        </div>
      </section>
    );
  }

  return (
    <section className={`testimonials animate-on-scroll ${inView ? 'in-view' : ''}`} ref={ref}>
      <div className="container">
        <h2>What Our Customers Say</h2>
        <div className="testimonials-grid">
          {reviews.map((review) => (
            <div key={review.id} className="testimonial-card">
              <div className="testimonial-rating">
                {[...Array(5)].map((_, i) => (
                  <span 
                    key={i} 
                    className={`star ${i < review.rating ? 'filled' : ''}`}
                  >
                    ★
                  </span>
                ))}
              </div>
              <blockquote className="testimonial-content">
                {review.content}
              </blockquote>
              <footer className="testimonial-author">
                <cite>{review.author}</cite>
                <time dateTime={review.date}>
                  {new Date(review.date).toLocaleDateString()}
                </time>
              </footer>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
