<?php
function saveImage($file, $path) {
    $uploadDir = $path;  // Directory to upload images
    $uniqueName = uniqid() . '_' . basename($file['name']); // Generate a unique name for the image

    $targetPath = $uploadDir . $uniqueName; // Path to save the image

    $response = array(); // Initialize the response array

    // Check if the file is an image
    $imageFileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    
    if (!in_array($imageFileType, $allowedTypes)) {
        $response['saved'] = false;
        $response['result'] = "Invalid image file type.";
        return $response;
    }

    // Move the uploaded file to the target path
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        $response['saved'] = true;
        $response['result'] = $uniqueName;
    } else {
        $response['saved'] = false;
        $response['result'] = "Error saving image.";
    }
    
    return $response; // Return the response array
}

function replaceImage($oldImageName, $newImageFile, $path) {
    $uploadDir = $path;  // Directory to upload images
    $uniqueName = uniqid() . '_' . basename($newImageFile['name']); // Generate a unique name for the new image

    $targetPath = $uploadDir . $uniqueName; // Path to save the new image

    $response = array(); // Initialize the response array

    // Check if the new file is an image
    $imageFileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

    if (!in_array($imageFileType, $allowedTypes)) {
        $response['saved'] = false;
        $response['result'] = "Invalid image file type.";
        return $response;
    }

    // Delete the old image if it exists
    $oldImagePath = $uploadDir . $oldImageName;
    if (file_exists($oldImagePath)) {
        unlink($oldImagePath);
    }

    // Move the new uploaded file to the target path
    if (move_uploaded_file($newImageFile['tmp_name'], $targetPath)) {
        $response['saved'] = true;
        $response['result'] = $uniqueName;
    } else {
        $response['saved'] = false;
        $response['result'] = "Error saving image.";
    }

    return $response; // Return the response array
}
?>