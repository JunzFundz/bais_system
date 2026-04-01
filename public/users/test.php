<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signature Canvas</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }
        .canvas-container {
            position: relative;
            display: inline-block;
            margin: 20px;
        }
        #signature {
            cursor: crosshair;
            background: white;
            border: 2px solid #333;
            border-radius: 4px;
            display: block;
        }
        #clear-signature {
            position: absolute;
            top: 5px;
            right: 5px;
            padding: 5px 10px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }
        #clear-signature:hover {
            background: #dc2626;
        }
    </style>
</head>
<body>
    <h2>Draw Your Signature (Mac/Brave)</h2>
    
    <div class="canvas-container">
        <canvas id="signature" width="320" height="160"></canvas>
        <button id="clear-signature">Clear</button>
    </div>
    
    <br>
    <button id="save-signature" class="px-4 py-2 bg-blue-500 text-white rounded">Save Signature</button>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sigCanvas = document.getElementById('signature');
            const ctx = sigCanvas.getContext('2d');
            const clearBtn = document.getElementById('clear-signature');
            const saveBtn = document.getElementById('save-signature');

            let drawing = false;
            let lastX = 0;
            let lastY = 0;

            // Debug
            console.log('=== CANVAS DEBUG ===');
            console.log('Canvas:', sigCanvas);
            console.log('Context:', ctx);
            console.log('Canvas width:', sigCanvas.width);
            console.log('Canvas height:', sigCanvas.height);
            console.log('Touch support:', 'ontouchstart' in window);

            // Set canvas size (FIXED - no resize needed)
            sigCanvas.width = 320;
            sigCanvas.height = 160;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            ctx.lineWidth = 2;
            ctx.strokeStyle = '#000';

            // Get position relative to canvas
            function getPos(e) {
                const rect = sigCanvas.getBoundingClientRect();
                return {
                    x: e.clientX - rect.left,
                    y: e.clientY - rect.top
                };
            }

            // Mouse events
            sigCanvas.addEventListener('mousedown', (e) => {
                e.preventDefault();
                drawing = true;
                const pos = getPos(e);
                lastX = pos.x;
                lastY = pos.y;
                ctx.beginPath();
                ctx.moveTo(lastX, lastY);
                console.log('✓ Drawing started at:', lastX, lastY);
            });

            sigCanvas.addEventListener('mouseup', (e) => {
                e.preventDefault();
                drawing = false;
                ctx.beginPath();
                console.log('✓ Drawing stopped');
            });

            sigCanvas.addEventListener('mouseout', (e) => {
                e.preventDefault();
                drawing = false;
                ctx.beginPath();
            });

            sigCanvas.addEventListener('mousemove', (e) => {
                e.preventDefault();
                if (!drawing) return;
                const pos = getPos(e);
                ctx.lineTo(pos.x, pos.y);
                ctx.stroke();
                lastX = pos.x;
                lastY = pos.y;
            });

            // Clear button
            clearBtn.addEventListener('click', () => {
                ctx.clearRect(0, 0, sigCanvas.width, sigCanvas.height);
                console.log('✓ Canvas cleared');
            });

            // Save button
            saveBtn.addEventListener('click', () => {
                const dataURL = sigCanvas.toDataURL('image/png');
                console.log('✓ Signature saved:', dataURL);
                alert('Signature saved! Check console for data URL.');
            });
        });
    </script>
</body>
</html>