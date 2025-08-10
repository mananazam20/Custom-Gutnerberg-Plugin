export default function Save() {
  return (
    <form className="sam-newsletter-form">
      <input type="text" name="name" placeholder="Your Name" required  className="sam-input"/>
      <input type="email" name="email" placeholder="Your Email" required className="sam-input" />
      <button type="submit" className="sam-button">Subscribe</button>

      <div id = "message"></div>
    </form>
  );
}
