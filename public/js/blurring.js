// Principle: The Gaussian blur calculates the blur for each pixel according to the radius.
// As it has a O(nr²) complexity, we use the Box blur instead to simulate a Gaussian blur.
// The Box blur uses a fixed square weight, computed by boxesForGauss()
// The total box algo is split in half horizontally and vertically, and then combined
// The blur for contiguous pixels is nearly the same: minus the leftmost pixels, plus
// the rightmost pixels. So we use an accumulator to read through the image, and modify
// it at each pixel instead of recalculating all. Complexity O(n).

// Approximation of Gaussian blur (average deviation 0.04%/px)
// Source img, Result img, height, width, radius
export function gaussBlur (sImg, w, h, r) {
	var rImg = [];
    var bxs = boxesForGauss(r, 3);
    boxBlur (sImg, rImg, w, h, (bxs[0]-1)/2);
    boxBlur (rImg, sImg, w, h, (bxs[1]-1)/2);
    boxBlur (sImg, rImg, w, h, (bxs[2]-1)/2);
    return rImg;
}

// One iteration of the box blur algorithm
function boxBlur (sImg, rImg, w, h, r) {
    for(var i=0; i<sImg.length; i++) rImg[i] = sImg[i];
    boxBlurH(rImg, sImg, w, h, r);
    boxBlurT(sImg, rImg, w, h, r);
}

// Horizontal box blur (one line)
function boxBlurH (sImg, rImg, w, h, r) {
    var iarr = 1 / (r+r+1);
    for(var i=0; i<h; i++) {
        var ti = i*w, li = ti, ri = ti+r;
        var fv = sImg[ti], lv = sImg[ti+w-1], val = (r+1)*fv;
        for(var j=0; j<r; j++) val += sImg[ti+j];
        for(var j=0  ; j<=r ; j++) { val += sImg[ri++] - fv        ;   rImg[ti++] = Math.round(val*iarr); }
        for(var j=r+1; j<w-r; j++) { val += sImg[ri++] - sImg[li++];   rImg[ti++] = Math.round(val*iarr); }
        for(var j=w-r; j<w  ; j++) { val += lv         - sImg[li++];   rImg[ti++] = Math.round(val*iarr); }
    }
}

// Vertical box blur (total)
function boxBlurT (sImg, rImg, w, h, r) {
    var iarr = 1 / (r+r+1);
    for(var i=0; i<w; i++) {
        var ti = i, li = ti, ri = ti+r*w;
        var fv = sImg[ti], lv = sImg[ti+w*(h-1)], val = (r+1)*fv;
        for(var j=0; j<r; j++) val += sImg[ti+j*w];
        for(var j=0  ; j<=r ; j++) { val += sImg[ri] - fv      ;  rImg[ti] = Math.round(val*iarr);  ri+=w; ti+=w; }
        for(var j=r+1; j<h-r; j++) { val += sImg[ri] - sImg[li];  rImg[ti] = Math.round(val*iarr);  li+=w; ri+=w; ti+=w; }
        for(var j=h-r; j<h  ; j++) { val += lv       - sImg[li];  rImg[ti] = Math.round(val*iarr);  li+=w; ti+=w; }
    }
}

// Calculates the standard deviation into dimensions of boxes
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
