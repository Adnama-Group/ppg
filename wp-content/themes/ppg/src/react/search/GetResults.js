import { useState } from '@wordpress/element';
import renderPost from './renderPost';

const GetResults = ({ posts }) => {

    let [display, setDisplay] = useState(9);
    let arr = []
    let first = 206;
    
    // posts.forEach( (el, idx) => {
    //     if(el.categories.includes(first)){
    //         let featured = posts.splice(idx,1);
    //         arr.unshift(featured[0]);
    //     } else {
    //         arr.push(el);
    //     }
    // })

    const sortedPosts = posts.sort((a, b) => {
        const aDate = new Date(a.date);
        const bDate = new Date(b.date);
        return bDate - aDate;
    });

    const loadMore = (e) => {
        e.preventDefault();
        setDisplay(display + 9);
    }

    return(
        <>
            <div className={`blog-grid__results row`}>        
                {sortedPosts && sortedPosts.filter( post => {
                        // if( search != null) {
                        //     return post.title.rendered.toLowerCase().includes(search);
                        // }
                        return post;
                    }).map((filteredPost, idx) => (
                        idx < display ? renderPost(filteredPost, idx) : null
                    ))
                } 
            </div>
            <div className={`blog-grid__results-more`}>
                { display < sortedPosts.length ? (
                    <button className={`button red-button`} onClick={ (e) => { loadMore( e ) } }>View More +</button>
                ) : (
                    <p></p>
                ) }
            </div>
        </>
    )
}

export default GetResults;