<?php
function callGeminiAPI($query) {
    // Replace with your actual Gemini API key
    $api_key = "PUT_YOUR_GEMINI_API_KEY";
    // API endpoint
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent?key=" . $api_key;
    // Set up the request payload
    $data = [
        "contents" => [
            [
                "parts" => [
                    ["text" => "Refine the following search query for an e-commerce website into a single product name. Do not add extra words like 'styles' or 'designs'. Query: $query"]
                ]
            ]
        ]
    ];
    // Convert the payload to JSON
    $jsonData = json_encode($data);
    // Initialize cURL
    $ch = curl_init($url);
    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    // Execute cURL request
    $response = curl_exec($ch);
    // Check for cURL errors
    if (curl_errno($ch)) {
        $_SESSION['gemini_error'] = "cURL Error: " . curl_error($ch);
        curl_close($ch);
        return $query; // Fallback to the original query
    }
    curl_close($ch);
    // Decode the JSON response
    $responseData = json_decode($response, true);
    
    // Check for API errors including quota exceeded
    if (isset($responseData['error'])) {
        $errorCode = $responseData['error']['code'] ?? 0;
        $errorMessage = $responseData['error']['message'] ?? 'Unknown error';
        
        // Handle quota exceeded errors (usually code 429 or specific message)
        if ($errorCode == 429 || stripos($errorMessage, 'quota') !== false || stripos($errorMessage, 'rate limit') !== false) {
            $_SESSION['gemini_error'] = "Gemini API quota exceeded. Please try again later.";
        } else {
            $_SESSION['gemini_error'] = "Gemini API Error: " . $errorMessage;
        }
        
        return $query; // Fallback to the original query
    }
    
    // Extract the refined query
    if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
        $refinedQuery = $responseData['candidates'][0]['content']['parts'][0]['text'];
        // Trim and normalize the refined query
        $refinedQuery = trim($refinedQuery); // Remove extra spaces
        $refinedQuery = preg_replace('/[^a-zA-Z0-9\s]/', '', $refinedQuery); // Remove special characters
        // Ensure the refined query is no more than two words
        $words = explode(" ", $refinedQuery);
        if (count($words) > 2) {
            $refinedQuery = implode(" ", array_slice($words, 0, 2)); // Take only the first two words
        }
        return $refinedQuery;
    } else {
        $_SESSION['gemini_error'] = "Failed to process search query with Gemini API.";
        return $query; // Fallback to the original query
    }
}
?>
