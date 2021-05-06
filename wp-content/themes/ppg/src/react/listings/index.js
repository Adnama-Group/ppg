import { Component } from 'react';
// import GetResults from './GetResults';

class Listings extends Component {
    
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


    render(){
        return(
            <div className={ `listings-grid` }>
                {this.state.posts.map( listing => {
                    console.log(listing);
                    if(listing.author !== parseInt(this.state.user)) return null;
                    return(
                        <div className={ `listings-grid__single` }>
                            <div className={ `listings-grid__col listings-grid__col--primary` }>
                                Test
                            </div>
                            <div className={ `listings-grid__col` }>

                            </div>
                            <div className={ `listings-grid__col` }>

                            </div>
                        </div>
                    )
                })}
            </div>
        );
    }
}

export default Listings;