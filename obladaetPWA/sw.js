const CACHE_NAME = 'players-club-v1';
const urlsToCache = [
  '/',
  '/index.php',
  '/style.css',
  '/img/Главная.png',
  '/img/Главная2.png'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request))
  );
});