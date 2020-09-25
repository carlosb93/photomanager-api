const CACHE_NAME = 'AutosubastaRN2_V1';
const STATIC_CACHE_URLS = [
'/index.php',
'/css/app.css',
'/js/Administracion.js',
'/js/app.js',
'/js/common.js',
'/js/Perfil.js',
'/js/subasta-venta.js',
'/vendors~js/common.js',
'/mix-manifest.json',
'/favicon.ico',
'/images/auto.jpg',
'/images/logo.png',
'/images/avatar.png',
];

self.addEventListener('install', event => {
  console.log('Service Worker installing.');
  event.waitUntil(
    caches.open(CACHE_NAME)
	.then(cache => cache.addAll(STATIC_CACHE_URLS))
	.catch((error) => { console.log(error)})
  )
});

self.addEventListener('activate', function () {
  console.log('SW Activated');
});

self.addEventListener('fetch', event => {
  // Cache-First Strategy
  console.log('Cache-First Strategy.');
  event.respondWith(
    caches.match(event.request) // check if the request has already been cached
	.then(cached => cached || fetch(event.request)) // otherwise request network
	.catch((error) => { console.log(error)})
  )
});

self.addEventListener('fetch', event => {
if(event.request.url.includes("/api/")){
  // response to API requests, Cache Update Refresh strategy
  event.respondWith(caches.match(event.request))
  event.waitUntil(update(event.request).then(refresh))
  .catch((error) => { console.log(error)})
}
})



function update(request) {
	return fetch(request.url)
	.then(response => {
		if (!response.ok) { throw new Error('Network error'); }
		// we can put response in cache
		return caches.open(CACHE_NAME)
		.then(cache => cache.put(request, response.clone()))
		.then(() => response) // resolve promise with the Response object
	})
}

function refresh(response) {
	return response.json() // read and parse JSON response
	.then(jsonResponse => {
		self.clients.matchAll().then(clients => {
			clients.forEach(client => {
				// report and send new data to client
				client.postMessage(JSON.stringify({
                    type: response.url,
                    data: jsonResponse.data
                }))
			})
		})
		return jsonResponse.data; // resolve promise with new data
	})
}
