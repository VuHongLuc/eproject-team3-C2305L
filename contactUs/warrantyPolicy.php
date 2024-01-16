<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>WARRANTY POLICY</title>

    <style>
        .custom-button {
            background-color: #dc3545;
            color: #fff;
        }

        .custom-link {
            color: #007bff !important;
            text-decoration: none !important;
        }

        .container h1 {
            text-align: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .textDecreption {
            animation: fadeIn 0.8s ease-out;
        }

        .bold-link {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php include '../home/navbar.php'; ?>

    <div class="wrapper container-fluid textDecreption ">
        <div class="container col-inner">
            <h1 class="my-3">WARRANTY POLICY</h1>

            <h2 class="my-3">Warranty policy of OceanGate</h2>

            <p><a href="../index/index.php" class="custom-link bold-link">OceanGate</a> assures the original end user that its products are free from defects in materials and workmanship under the terms and conditions outlined herein. Subject to the conditions and limitations below, OceanGate will repair or replace any defective product part due to improper manufacturing techniques or materials. Repaired parts or replacement products, provided by OceanGate on an exchange basis, will be either new or recertified, with recertified products thoroughly tested to ensure they function as new.</p>

            <p>If OceanGate cannot repair or replace the product, a refund will be provided for the lesser of the current product value at the warranty claim time or the purchase price. Proof of purchase showing the date, place of original purchase, product description, and price is required.</p>

            <p><strong>This limited warranty does not cover:</strong></p>

            <ol>
                <li> Damage resulting from improper installation, accident, abuse, misuse, act of God, excessive power supply, abnormal mechanical or environmental conditions, or unauthorized dismantling, repair, or modification.</li>

                <li> Instances where the product is not used in accordance with accompanying instructions or not for its intended purpose.</li>

                <li> Any product with altered or defaced original identification, improper handling or packaging, sold as-is, used, or resold against U.S. export regulations and other applicable export regulations.</li>
            </ol>

            <p><strong>Exclusions from warranty coverage:</strong></p>

            <ol>
                <li> Loss, damage, or corruption of content or data and associated costs.</li>

                <li> Determining the cause of system problems or removal, service, or installation of OceanGate products.</li>

                <li> Third-party software, connected devices, or stored data, for which OceanGate is not responsible for actual or consequential loss or damage.</li>
            </ol>

            <p>In case of a claim, OceanGate's sole and maximum liability will be to repair and replace the hardware or provide a refund, as determined by OceanGate Vietnam.</p>

            <h2 class="my-3">Lifetime product warranty</h2>

            <ul>
                <li><strong>Lifetime product warranty:</strong> The following OceanGate products are covered by a lifetime product warranty:</li>
                
                <ul><li>Memory modules include ValueRAM®, HyperX®, Server Premier, Retail Memory, and OceanGate system-specific memory.</li></ul>

                
                <ul><li>Flash memory cards (e.g., Secure Digital, Secure Digital HC, and Change Flash).</li></ul>
            </ul>

            <ul>
                <li><strong>5-year warranty:</strong> The following OceanGate products are covered by this warranty for five years from the date of the original retail purchase:</li>
                
                <ul><li>DataTraveler® USB Drives (except DataTraveler® Workspace).</li></ul>
                <ul><li>Internal Design Client DRAM (“CBD”).</li></ul>
                <ul><li>IronKey® USB Drives.</li></ul>
                <ul><li>SSDNow® KC100 (solid-state drive).</li></ul>
                <ul><li>Industrial temperature microSD cards.</li></ul>
      
            </ul>

            <ul>
                <li><strong>Conditional 5-year SSD warranty:</strong> The following OceanGate products are covered by this warranty, whichever of the following events occurs first:</li>
                <ul>
                    <li>Five (5) years from the date of purchase by the end-user customer.</li>
                    <li>When the usage of a SATA SSD as measured by OceanGate's SMART 231 attribute, called “SSD Wear Index,” reaches a normalized value of one (1) as shown by the OceanGate SSD Manager (“KSM”);</li>
                    <li>When the usage of an NVME SSD as indicated by the OceanGate “Usage Percentage” Health attribute reaches or exceeds the normalized value of one hundred (100) as shown by KSM.</li>
                </ul>
            </ul>

            <p>KSM is specified in the product data sheet and is available on the OceanGate website. For SATA SSDs, new unused products start with a wear rating of one hundred (100), while products that have reached the warranty limit will have a wear rating of one (1). For NVMe SSDs, new unused products start with a Usage Percentage value of 0, while products that have reached the warranty limit will have a Usage Percentage value greater than or equal to one hundred (100).</p>

            <h2 class="my-4">Free Technical Support</h2>

            <p>If you encounter difficulties during installation or use of OceanGate products, you can contact OceanGate Vietnam's Technical Support department.</p>

            <p>To receive support, please contact <a href="../index/index.php" class="custom-link bold-link">OceanGate@oceangate.com.vn</a> or Hotline <strong>1800 1141</strong>.</p>
        </div>
    </div>
    <?php include '../home/footer.html' ?>

</body>

</html
