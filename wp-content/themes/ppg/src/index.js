import Listings from './react/listings';
import Search from './react/search';

(function(window, document, undefined){
    window.onload = init;

    function init(){
        const listings = document.getElementById("listings-app");
        const search = document.getElementById("search-pets");
        // console.log('test');
        if (listings) {
            const user_id = listings ? listings.dataset.id : null;
            ReactDOM.render( <Listings id={user_id} />, listings); 
        }
        if (search) {
            ReactDOM.render( <Search />, search); 
        }
    }

})(window, document, undefined);