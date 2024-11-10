<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Dokumen</title>
</head>
<body>
    <?php
        // Define dynamic content
        $title = "Sistem Informasi Pencatatan Dokumen Masuk Dan Pengarsipan";
        $subtitle = "Studi Kasus: Kantor Perwakilan Bank Indonesia Provinsi Sulawesi Utara";
        $author1 = ["name" => "Juandri H. I. Kawulusan", "id" => "1209008"];
        $author2 = ["name" => "Javear J. P. L. Pendang", "id" => "1209061"];
        $coverImage = "path/to/cover.jpg"; // Replace with actual image path
    ?>

    <!-- Header Section -->
    <div style="background-color: #6259ca; padding: 50px; color: white; text-align: center; position: relative;">
        <img src="{{ asset('storage/logo/LOGO_PST.png') }}" alt="Logo"
         style="width: 200px; height: auto; position: absolute; top: 50%; left: 20px; transform: translateY(-50%);">

    <!-- Header Text, Positioned with Padding to Avoid Overlap with Logo -->
    <h1 style="margin: 0; font-size: 1.5rem;">WEB ARSIP DOKUMEN</h1>
    <h2 style="margin: 0; font-size: 1rem;">PT PRATAMA SOLUSI TEKNOLOGI</h2>

        <!-- Search Bar -->
        <div style="margin-top: 15px; position: absolute; top: 30px; right: 20px;">
            <input type="text" placeholder="e.g. Library and Information" style="padding: 8px; border-radius: 20px; border: none; width: 200px; margin-right: 10px;">
            <button style="padding: 8px 12px; border-radius: 20px; border: none; background-color: #ffffff; color: #0c7cb6; cursor: pointer;">PENCARIAN</button>
        </div>
    </div>

    <!-- Main Content -->
    <div style="display: flex; justify-content: center; padding: 20px;">
        <div style="width: 70%;">
            <h2 style="font-size: 1.4rem; margin-top: 0;">Detail Dokumen</h2>
            <h3><?php echo $title; ?></h3>
            <p><strong><?php echo $subtitle; ?></strong></p>

            <!-- Details Section -->
            <div style="display: flex; align-items: flex-start; margin-top: 20px;">
                <!-- Book Cover -->
                <img src="<?php echo $coverImage; ?>" alt="Book Cover" style="width: 150px; height: 200px; border: 1px solid #ddd; margin-right: 20px;">

                <!-- Information Box -->
                <div style="flex-grow: 1; padding: 10px; background-color: #f2f2f2; border-radius: 8px;">
                    <h3 style="margin: 0; font-size: 1.2rem;">Informasi</h3>
                    <p style="margin: 10px 0;">Detail informasi</p>
        <!-- Buttons Section -->
        <div class="buttons" style="margin-top: 20px;">
            <button class="back-button" style="padding: 10px 20px; background-color: #333; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">
                    <p>
                        <?php echo $author1['name']; ?> - Personal Name |
                        <?php echo $author2['name']; ?> - Personal Name
                    </p>
                </div>
            </div>

            <!-- Buttons Section -->
            <div style="margin-top: 20px;">
                <button style="padding: 10px 20px; background-color: #333; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">KEMBALI KE SEBELUMNYA</button>
                <button style="padding: 10px 20px; background-color: #333; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">XML DETAIL</button>
                <button style="padding: 10px 20px; background-color: #333; color: white; border: none; border-radius: 5px; cursor: pointer;">CITE THIS</button>
            </div>
        </div>
    </div>
</body>
</html>
