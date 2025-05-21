'use client';

export default function Footer() {
  return (
    <footer className="site-footer">
      <div className="container">
        <div className="footer-grid">
          <div className="footer-info">
            <h3>Little Miami Brewing Company</h3>
            <p>Craft Beer & Good Times</p>
            <address>
              123 River Valley Road<br />
              Cincinnati, OH 45202
            </address>
          </div>
          
          <div className="footer-hours">
            <h4>Hours</h4>
            <p>Monday-Thursday: 11am-10pm</p>
            <p>Friday-Saturday: 11am-12am</p>
            <p>Sunday: 11am-9pm</p>
          </div>
          
          <div className="footer-contact">
            <h4>Contact</h4>
            <p>Phone: (513) 555-0123</p>
            <p>Email: info@littlemiamibrewing.com</p>
          </div>
          
          <div className="footer-social">
            <h4>Follow Us</h4>
            <div className="social-icons">
              <a href="#" className="social-icon"><i className="fab fa-facebook-f"></i></a>
              <a href="#" className="social-icon"><i className="fab fa-instagram"></i></a>
              <a href="#" className="social-icon"><i className="fab fa-twitter"></i></a>
            </div>
          </div>
        </div>
        
        <div className="footer-bottom">
          <p>&copy; {new Date().getFullYear()} Little Miami Brewing Company. All rights reserved.</p>
        </div>
      </div>
    </footer>
  );
}
