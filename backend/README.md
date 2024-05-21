# wiri backend
this is the backend of wiri, It handles all of our request. the setup is just like any other basic laravel app.

## setup
install the packages using `composer install` and then copy the .env.example to .env. 

## boring design shit
models: 
    - users 
    - companies(stores, growers, transporters)
    - products(concentrates,buds, rolling paper)
    - reviews/comments

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
        enum type "store producer"
        str name
        str about
    }
    PRODUCTS {
        uuid id
        str name
        str about
        uuid producer_id 
        timestamp created_at
        timestamp updated_at
        timestamp deleted_at
    }
    PRODUCT_META {
        uuid id
        uuid product_id
        str key
        str value
        datetime created_at
        datetime updated_at
        datetime deleted_at
    }

    REVIEW {
        uuid id 
        uuid author_id 
        str content
        bool approved
    }

    USER||--o{PRODUCERS : "is"
    USER||--o{REVIEW: "has"
    PRODUCERS||--o{PRODUCTS: "has"
    PRODUCTS||--o{PRODUCT_META: "owns"
```

## todo
- [x] create user model
- [x] create company model that links to user
- [ ] create product model
- [ ] create review 
- [ ] implement auth for company
- [ ] implement auth for review
- [ ] add media to company
- [ ] add media to products
- [ ] implement $user-can() in be
- [ ] do security audit of fillible fields 

## faq 
**could not find driver (Connection: sqlite, SQL: PRAGMA foreign_keys = ON;)**
you need to install the php-sqlite extension