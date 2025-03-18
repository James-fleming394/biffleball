<?php
require_once __DIR__ . '/../models/Team.php';

class ApiController {
    public static function updateTeamWins() {
        $apiUrl = "https://api.sportsdata.io/v3/mlb/scores/json/Standings"; // API endpoint will be changed
        $apiKey = "YOUR_API_KEY";  // Replace with actual API key

        // Set up cURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Ocp-Apim-Subscription-Key: $apiKey"]);

        // Execute request
        $response = curl_exec($ch);
        curl_close($ch);

        // Decode API response
        $teamsData = json_decode($response, true);
        if (!$teamsData) {
            echo "Failed to fetch team data.";
            return;
        }

        // Loop through API data and update teams in the database
        foreach ($teamsData as $team) {
            Team::updateWins($team['Key'], $team['Wins']);
        }

        echo "Team wins updated successfully!";
    }
}

// Handle API call
if (isset($_GET['action']) && $_GET['action'] === 'update-wins') {
    ApiController::updateTeamWins();
}
?>
