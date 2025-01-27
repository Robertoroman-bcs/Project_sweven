<style>
    .org-chart {
        height: 100vh;
    }

    .org-chart ul {
        padding: 20px 0;
        position: relative;
        transition: all 0.5s;
        list-style-type: none;
    }

    .org-chart ul ul {
        padding-top: 20px;
    }

    .org-chart li {
        float: left;
        text-align: center;
        list-style-type: none;
        position: relative;
        padding: 20px 5px 0 5px;
        transition: all 0.5s;
        margin-bottom: 20px;
    }

    .org-chart li::before,
    .org-chart li::after {
        content: "";
        position: absolute;
        top: 0;
        right: 50%;
        border-top: 2px solid #4a90e2;
        width: 50%;
        height: 20px;
    }

    .org-chart li::after {
        right: auto;
        left: 50%;
        border-left: 2px solid #4a90e2;
    }

    .org-chart li:only-child::after,
    .org-chart li:only-child::before {
        display: none;
    }

    .org-chart li:only-child {
        padding-top: 0;
    }

    .org-chart li:first-child::before,
    .org-chart li:last-child::after {
        border: 0 none;
    }

    .org-chart li:last-child::before {
        border-right: 2px solid #4a90e2;
        border-radius: 0 5px 0 0;
    }

    .org-chart li:first-child::after {
        border-radius: 5px 0 0 0;
    }

    .org-chart ul ul::before {
        content: "";
        position: absolute;
        top: 0;
        left: 50%;
        border-left: 2px solid #4a90e2;
        width: 0;
        height: 20px;
    }

    .org-chart li .node {
        border: 2px solid #4a90e2;
        padding: 10px;
        text-decoration: none;
        color: #333;
        font-size: 14px;
        display: inline-block;
        min-width: 150px;
        min-height: 60px;
        background-color: #fff;
        border-radius: 5px;
        transition: all 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .org-chart li .node:hover {
        background-color: #4a90e2;
        color: #fff;
        transform: translateY(-5px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .org-chart li .node h2,
    .org-chart li .node h3 {
        margin: 0;
        padding: 5px 0;
        font-size: 16px;
        transition: all 0.3s;
    }

    .org-chart li .node:hover h2,
    .org-chart li .node:hover h3 {
        color: #fff;
    }

    .tooltip {
        position: absolute;
        background-color: rgba(0, 0, 0, 0.8);
        color: #ffffff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        z-index: 9999;
        white-space: nowrap;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s ease;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        margin-bottom: 25px;
        height: 40px;
    }

    .node:hover .tooltip {
        opacity: 1;
    }

    @media screen and (max-width: 768px) {
        .org-chart ul {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .org-chart li {
            float: none;
            display: block;
            padding: 20px 0 0 0;
        }

        /* .org-chart li::before,
  .org-chart li::after,
  .org-chart ul ul::before {
    display: none;
  } */

        .org-chart li .node {
            min-width: 200px;
        }
    }
</style>



<div class="org-chart">
    <ul>
        <li>
            <div class="node" data-info="Oversees all company operations" style="background-color: #808080">
                <h2>DIRECIÓN GENERAL</h2>
            </div>
            <ul>
                <li>
                    <div class="node" data-info="Manages financial resources and reporting">
                        <h3>VENTAS</h3>
                    </div>
                </li>
                <li>
                    <div class="node" data-info="Handles employee relations and recruitment">
                        <h3>BDC VENTAS</h3>
                    </div>
                </li>
                <li>
                    <div class="node" data-info="Develops and maintains IT infrastructure">
                        <h3>BDC POSTVENTA</h3>
                    </div>
                </li>
                <li>
                    <div class="node" data-info="Manages marketing strategies and brand image">
                        <h3>HUB USADOS</h3>
                    </div>
                </li>
                <li>
                    <div class="node" data-info="Oversees sales operations and customer acquisition">
                        <h3>REFACCIONES</h3>
                    </div>
                </li>
                <li>
                    <div class="node" data-info="Ensures product quality and manufacturing efficiency">
                        <h3>HOJALATERIA Y PINTURA</h3>
                    </div>
                </li>
                <li>
                    <div class="node" data-info="Manages research and development of new products">
                        <h3>SEMINUEVOS</h3>
                    </div>
                </li>
                <li>
                    <div class="node" data-info="Handles legal matters and compliance">
                        <h3>MERCADOTECNIA</h3>
                    </div>
                </li>
                <li>
                    <div class="node" data-info="Manages customer support and satisfaction">
                        <h3>GRUPO INSIGNIA</h3>
                    </div>
                </li>
                <li>
                    <div class="node" data-info="Oversees supply chain and logistics">
                        <h3>TRANSFORMACIÓN</h3>
                    </div>
                </li>
                <li>
                    <div class="node" data-info="Manages public relations and corporate communications">
                        <h3>SERVICIO</h3>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const nodes = document.querySelectorAll(".node")

        nodes.forEach((node) => {
            node.addEventListener("mouseenter", showInfo)
            node.addEventListener("mouseleave", hideInfo)
        })

        function showInfo(event) {
            const node = event.target
            const info = node.getAttribute("data-info")

            if (info) {
                const tooltip = document.createElement("div")
                tooltip.className = "tooltip"
                tooltip.textContent = info

                node.appendChild(tooltip)

                const rect = node.getBoundingClientRect()
                const tooltipRect = tooltip.getBoundingClientRect()


                tooltip.style.top = `${-rect.height}px`
                tooltip.style.backgroundColor = "black"

            }
        }

        function hideInfo(event) {
            const tooltip = event.target.querySelector(".tooltip")
            if (tooltip) {
                tooltip.remove()
            }
        }
    })
</script>