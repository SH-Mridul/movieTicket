document.addEventListener('DOMContentLoaded', function () {
    // Load content for different categories
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default anchor behavior
            const target = this.getAttribute('data-target');
            loadContent(target);
        });
    });

    function loadContent(target) {
        let contentHTML = '';

        switch (target) {
            case 'customers':
                contentHTML = `
                    <h2>Customers</h2>
                    <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nuzhat Tahsin</td>
                            <td>nuzhat@gmail.com</td>
                            <td>01819345622</td>
                            <td>Active</td>
                        </tr>
                        <tr>
                            <td>Rayan Smith</td>
                            <td>rayan@gmail.com</td>
                            <td>01879376622</td>
                            <td>Inactive</td>
                        </tr>
                        <tr>
                            <td>Riya Tasmia</td>
                            <td>riya@gmail.com</td>
                            <td>01237656622</td>
                            <td>Active</td>
                        </tr>
                        <tr>
                            <td>Sultana Binte</td>
                            <td>sbinte@gmail.com</td>
                            <td>01873952473</td>
                            <td>Inactive</td>
                        </tr>
                        <tr>
                            <td>Saima Jannat</td>
                            <td>saima@gmail.com</td>
                            <td>01315982562</td>
                            <td>Inactive</td>
                        </tr>
                    </tbody>
                </table>
            `;
                break;
            case 'bookings':
                contentHTML = `
                <h2>Bookings</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Customer Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1001</td>
                            <td>Nuzhat Tahsin</td>
                            <td>Confirmed</td>
                        </tr>
                        <tr>
                            <td>1002</td>
                            <td>Rayan Smith</td>
                            <td>Cancelled</td>
                        </tr>
                        <tr>
                        <td>1003</td>
                        <td>Riya Tasmia</td>
                        <td>Confirmed</td>
                    </tr>
                    <tr>
                    <td>1004</td>
                    <td>Sultana Binte</td>
                    <td>Confirmed</td>
                </tr>
                <tr>
                            <td>1005</td>
                            <td>Saima Jannat</td>
                            <td>Cancelled</td>
                        </tr>
                    </tbody>
                </table>
            `;
                break;
            case 'movies':
                contentHTML = `
                <h2>Movies</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Release Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>12th Fail</td>
                            <td>2024-01-01</td>
                            <td>Showing</td>
                        </tr>
                        <tr>
                            <td>Spider Man (No Way Home)</td>
                            <td>2024-01-01</td>
                            <td>Showing</td>
                        </tr>
                        <tr>
                            <td>A Quiet Place 3</td>
                            <td>2024-02-10</td>
                            <td>Upcoming</td>
                            </tr>
                        <tr>
                            <td>Shurongo</td>
                            <td>2024-04-20</td>
                            <td>Upcoming</td>
                        </tr>
                    </tbody>
                </table>
            `;
                break;
            case 'seats':
                contentHTML = `
                <h2>Seats</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Seat Number</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>A1</td>
                            <td>Available</td>
                        </tr>
                        <tr>
                            <td>A2</td>
                            <td>Reserved</td>
                        </tr>
                    </tbody>
                </table>
            `;
                break;
            default:
                contentHTML = '<h2>Welcome! Please select a category.</h2>';
        }

        document.getElementById('content').innerHTML = contentHTML;
    }
});
