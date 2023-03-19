# Foto
Self host google photo like service.


## Setup laravel
```bash
$ cd panel && \
  composer install && \
  php artisan key:generate
```

## Setup python libraries
Before instll python libraries you need to install `dlib` library which you can see in this [link](https://gist.github.com/ageitgey/629d75c1baac34dfa5ca2a1928a7aeaf).
```bash
$ cd vision && \
  python -m venv .venv && \
  source .venv/bin/activate && \
  .venv/bin/python -m pip install -r requirements.txt
```

## ER Diagram
```mermaid
    erDiagram
        users ||--o{ images : "Has Many"
        images }o--o{ persons : "Many to Many"
        persons ||--|{ faces : "Has Many"
        faces ||--|| persons : "Has One"
```

## Database Diagram
```mermaid
    erDiagram
        users ||--o{ images : "Has Many"
        images }o--o{ persons : "Many to Many"
        persons ||--|{ faces : "Has Many"
        faces ||--|| persons : "Has One"

        images {
            int id PK
            string name
            string path
            timestamp created_at
            timestamp updated_at
        }

        image_person {
            int image_id FK
            int person_id FK
            json coordinates
            timestamp created_at
            timestamp updated_at
        }

        persons {
            int id PK
            int face_id Fk "avatar"
            string name
            timestamp created_at
            timestamp updated_at
        }

        images }o--o| image_person  : "Many"
        image_person |o--o{ persons : "Many"

        faces {
            int id PK
            int person_id FK
            string image
            json encodings
            timestamp created_at
            timestamp updated_at
        }
```