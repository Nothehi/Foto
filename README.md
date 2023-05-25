# Foto
Self host google photo like service.


## Setup laravel
For setup you need to have composer and php, then follow these commands:
```bash
$ cd panel && \
  composer install && \
  php artisan key:generate
```
This project use databse as queue for queuing the detection of pictures, you also need run laravel queue like this:
```bash
php artisan queue:work --queue=detection --timeout=300
```

## Setup python libraries
Before instll python libraries you need to install `dlib` library which you can see in this [link](https://gist.github.com/ageitgey/629d75c1baac34dfa5ca2a1928a7aeaf).
```bash
$ cd vision && \
  python -m venv .venv && \
  source .venv/bin/activate && \
  .venv/bin/python -m pip install -r requirements.txt
```

## Database Diagram
```mermaid
    users ||--o{ photos : "Has Many"
    albums ||--|{ album_photo : "Many to Many"
    photos ||--|{ album_photo : "Many to Many"
    photos ||--o{ faces : "Has Many"
    characters |o--|{ faces : "Has Many"

    photos {
        int id PK
        int user_id FK
        string name
        string path
        timestamp created_at
        timestamp updated_at
    }

    albums {
        int id PK
        int user_id FK
        string name
        timestamp created_at
        timestamp updated_at
    }

    album_photo {
        int album_id FK
        int photo_id FK
        timestamp created_at
        timestamp updated_at
    }

    characters {
        int id PK
        uuid key
        string name
        timestamp created_at
        timestamp updated_at
    }

    faces {
        int id PK
        int photo_id FK
        int character_id FK "nullable"
        string image
        json encodings
        json coordinates
        timestamp created_at
        timestamp updated_at
    }
```