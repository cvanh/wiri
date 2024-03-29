# wiri backend
this is the backend of wiri, It handles all of our request. the setup is just like any other basic laravel app.

## boring design shit

users 
producers(stores, growers, transporters)
products
reviews

## docs
you can generate docs with `php artisan scribe:generate`

### db schema

```mermaid
erDiagram
    USER {
        uuid id 
        str name
        str email
        str verified_at
        str password
        str remember_token
    }
    PRODUCERS { 
        uuid id 
        enum type store,producer, etc
        str name
        str about
        str tags
    }
    PRODUCT {
        uuid id
        str name

    }
    PRODUCT_META {
        uuid id
        uuid product_id
        str meta_key
        str meta_value
    }

    REVIEW {
        uuid id 
        uuid author_id 
        bool approved
    }

    USER||--o{PRODUCER : "is"
    USER||--o{REVIEW: "has"
    PRODUCER||--o{PRODUCT: "has"
    PRODUCT||--o{PRODUCT_META: "owns"
```