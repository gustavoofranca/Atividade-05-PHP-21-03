<?php
/**
 * Image URLs extracted from outroprojeto
 * This file contains all image URLs found in the Angular project
 */

$imageUrls = [
    // Menu item images
    'combo_x_burguer' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500',
    'combo_salad_burguer' => 'https://as2.ftcdn.net/jpg/00/92/04/47/1000_F_92044757_K6rFzZN9mBNu7w8aJFNwEAhzkV0tefUo.jpg',
    'combo_bacon_burguer' => 'https://images.unsplash.com/photo-1553979459-d2229ba7433b?w=500',
    'x_burguer' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500',
    'salad_burguer' => 'https://images.unsplash.com/photo-1572802419224-296b0aeee0d9?w=500',
    'bacon_burguer' => 'https://images.unsplash.com/photo-1553979459-d2229ba7433b?w=500',
    'batata_frita' => 'https://images.unsplash.com/photo-1630384060421-cb20d0e0649d?w=500',
    'bacon_adicional' => 'https://images.unsplash.com/photo-1528607929212-2636ec44253e?w=500',
    'maionese_da_casa' => 'https://i.ibb.co/BVcg3Gdm/Novo-Projeto-1.png',
    'coca_cola_zero' => 'https://i.ibb.co/xnh4H9Z/image.png',
    'coca_cola' => 'https://confeiteiro.agilecdn.com.br/11464.png',
    'sprite' => 'https://i.ibb.co/v47Czbt6/image-2.png',
    'kuat' => 'https://i.ibb.co/xqbcNMH9/image-3.png',
    
    // Other images found in the project
    'logo' => 'https://i.ibb.co/ycjTp2kX/Logo.png',
    'background_gif' => 'https://media.giphy.com/media/IzNq7U7mX0ecLvNKh0/giphy.gif',
    'background_gif_alt' => 'https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExZW81dGlidmx3NTRwMGdxMnNybjlyMzVvZGhjdTVtaXB6b2MwNHBhZSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/IzNq7U7mX0ecLvNKh0/giphy.gif',
    
    // Asset images referenced (these would need to be downloaded and stored locally)
    'burger1' => 'assets/images/burger1.jpg',
    'burger2' => 'assets/images/burger2.jpg',
    'burger3' => 'assets/images/burger3.jpg',
    'hero_about' => 'assets/images/hero-about.jpg',
    'hero_bg' => 'assets/images/hero-bg.jpg'
];

/**
 * Function to get an image URL by its key
 * 
 * @param string $key The key of the image URL
 * @return string|null The image URL or null if not found
 */
function getImageUrl($key) {
    global $imageUrls;
    return isset($imageUrls[$key]) ? $imageUrls[$key] : null;
}

/**
 * Function to get all image URLs
 * 
 * @return array All image URLs
 */
function getAllImageUrls() {
    global $imageUrls;
    return $imageUrls;
}
?>