async function loadProducts() {
    try {
        const response = await fetch("/Integrated_Programming/InventorySystem/Inventory-Management-System/API/Products.php");

        const products = await response.json();

        const table = document.getElementById("productTable");

        table.innerHTML = "";

        products.forEach(product => {

            let status = "GOOD";

            if (product.stock_quantity <= 0) {
                status = "EMPTY";
            } else if (product.stock_quantity < 10) {
                status = "CRITICAL";
            } else if (product.stock_quantity < 20) {
                status = "LOW";
            }

            table.innerHTML += `
                <tr>
                    <td>${product.product_name}</td>
                    <td>${product.stock_quantity}</td>
                    <td>${product.unit}</td>
                    <td>
                        <span class="status ${status.toLowerCase()}">
                            ${status}
                        </span>
                    </td>
                    <td>
                        ${
                            product.stock_quantity > 0
                            ? `<a href="index.php?action=submit-request-Page&product_id=${product.product_id}&product_name=${encodeURIComponent(product.product_name)}&unit=${encodeURIComponent(product.unit)}&stock_quantity=${product.stock_quantity}" class="pullout-btn">Request</a>`
                            : `<a class="pullout-btn disabled" style="pointer-events:none;opacity:.4;">Request</a>`
                        }
                    </td>
                </tr>
            `;
        });

    } catch (error) {
        console.error(error);
    }
}

loadProducts();