onmessage = function(e) {
	const result = gaussBlurCustom(e.data[0], e.data[1], e.data[2], e.data[3]);
	postMessage(result);
}

// Adapted from: https://blog.ivank.net/fastest-gaussian-blur.html
// Algorithm 2. Could not do the 4 directly because they don't
// take into account 4 canals (rgba) for an image but only one

function gaussBlurCustom (data, w, h, r) {
	let bxs = boxesForGauss(r, 3);
	let dataCopy = [...data];
	let res = [];
	
    boxBlurCustom (dataCopy, res, w, h, (bxs[0]-1)/2);
    boxBlurCustom (res, dataCopy, w, h, (bxs[1]-1)/2);
    boxBlurCustom (dataCopy, res, w, h, (bxs[2]-1)/2);
    
	return res;
}

function boxesForGauss(sigma, n) { // standard deviation, number of boxes
    var wIdeal = Math.sqrt((12*sigma*sigma/n)+1);  // Ideal averaging filter width 
    var wl = Math.floor(wIdeal);  if(wl%2==0) wl--;
    var wu = wl+2;
				
    var mIdeal = (12*sigma*sigma - n*wl*wl - 4*n*wl - 3*n)/(-4*wl - 4);
    var m = Math.round(mIdeal);
    // var sigmaActual = Math.sqrt( (m*wl*wl + (n-m)*wu*wu - n)/12 );
				
    var sizes = [];  for(var i=0; i<n; i++) sizes.push(i<m?wl:wu);
    return sizes;
}

function boxBlurCustom (data, res, w, h, r) {
	for (let i=0; i<4*h; i+=4) {
		for (let j=0; j<4*w; j+=4) {
			for (let k=0; k<4; k++) {
				// For each canal of each pixel
				if (k==3) {
					res[i*w+j+k] = data[i*w+j+k];
				} else {
				res[i*w+j+k] = data[i*w+j+k];
					// Do the mean if not alpha (canal 3)
					let val = 0;
					for (let l=-r*4; l<r*4; l+=4) {
						for (let m=-r*4; m<r*4; m+=4) {
							// If the adjacent cases don't go over the limit, add the value to the mean
							if (i+l>=0 && i+l<4*h && j+m>=0 && j+m<4*w) {
								val += data[(i+l)*w+(j+m)+k];
							}
						}
					}
					res[i*w+j+k] = Math.round(val/((r+r+1)*(r+r+1)));
				}
			}
		}
	}
}
