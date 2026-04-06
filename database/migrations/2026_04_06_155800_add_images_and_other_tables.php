<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        DB::statement('
        CREATE TABLE images (
            id            BIGSERIAL,
            user_id       BIGINT NOT NULL,
            image_path    VARCHAR(255) NOT NULL,
            description   TEXT,
            created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            
            CONSTRAINT pk_images PRIMARY KEY(id),
            CONSTRAINT fk_images_users 
                FOREIGN KEY (user_id) 
                REFERENCES users (id) 
                ON DELETE CASCADE
        );
        ');

        DB::statement('
        CREATE TABLE comments (
            id          BIGSERIAL,
            user_id     BIGINT NOT NULL,
            image_id    BIGINT NOT NULL,
            content     TEXT NOT NULL,
            created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

            CONSTRAINT pk_comments PRIMARY KEY(id),
            CONSTRAINT fk_comments_users FOREIGN KEY (user_id) 
                REFERENCES users(id) ON DELETE CASCADE,
            
            CONSTRAINT fk_comments_images FOREIGN KEY (image_id) 
                REFERENCES images(id) ON DELETE CASCADE
        );
        ');

        DB::statement('
        CREATE TABLE likes (
            id          BIGSERIAL,
            user_id     BIGINT NOT NULL,
            image_id    BIGINT NOT NULL,
            created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            CONSTRAINT pk_likes PRIMARY KEY(id),
            CONSTRAINT fk_likes_users FOREIGN KEY (user_id) 
                REFERENCES users(id) ON DELETE CASCADE,             
            CONSTRAINT fk_likes_images FOREIGN KEY (image_id) 
                REFERENCES images(id) ON DELETE CASCADE
        );
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TABLE IF EXISTS likes');
        DB::statement('DROP TABLE IF EXISTS comments');
        DB::statement('DROP TABLE IF EXISTS images');
    }
};
