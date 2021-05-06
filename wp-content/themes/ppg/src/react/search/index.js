import { Component } from 'react';
import GetResults from './GetResults';

class Search extends Component {
    
    constructor(props) {
        super(props);
        this.state = {
            feed: window.location.protocol + "//" + window.location.host + "/" + 'wp-json/wp/v2/listings',
            user: props.id,
            posts: []
        };
        this.getFeed = this.getFeed.bind(this);
    }

    componentDidMount() {
        this.getFeed(this.state.feed);
    }

    getFeed = (feed) => {
        fetch(feed)
            .then(response => response.json())
            .then( data => {
                this.setState({
                    posts: data
                });
            })
            .catch((error) => {
                console.error(error);
            })
    }

    renderGrid = () => {
        if (this.state.posts) {
            const posts = Object.values(this.state.posts);
            return ( <GetResults posts={ posts } /> );
        }
    }


    render(){
        return(
            <div className={ `row` }>
                <div className={ `col-md-3` }>

                </div>
                <div className={ `col-md-9` }>
                    { this.renderGrid() } 
                </div>
            </div>
        );
    }
}

export default Search;