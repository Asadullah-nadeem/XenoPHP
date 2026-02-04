import './bootstrap';

// Initialize socket asynchronously if needed (for your backend logic)
import('./socket')
  .then(() => console.log('Socket initialized'))
  .catch((err) => console.error('Failed to initialize socket:', err));

console.log('XenoPHP Blade App initialized');
