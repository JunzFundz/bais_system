
$.ajaxSetup({
    dataType: 'json'
});


function addBrgy(e) {
    e.preventDefault();

    const brgy = $('#brgy').val();

    if (!brgy) {
        alert('Barangay field is required');
        return;
    }

    if (brgy.length < 2) {
        alert('Barangay name must be at least 2 characters');
        return;
    }

    if (brgy.length > 100) {
        alert('Barangay name must be less than 100 characters');
        return;
    }

    if (!/^[a-zA-Z\s-]+$/.test(brgy)) {
        alert('Barangay name can only contain letters, spaces, and hyphens');
        return;
    }

    $.ajax({
        url: '../../data/admin-operation.php',
        type: 'POST',
        data: {
            addData: true,
            brgy: brgy
        },
        success: function (response) {
            if (response.status === 'success') {
                $('#brgy').val('');
            }
            $('#content-navigations').html(response.message);
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            $('#content-navigations').html('<p class="text-red-500">An error occurred</p>');
        },
        timeout: 10000 // 10 seconds
    });
}

function addOfficial() {
    // e.preventDefault();
    // Get values
    const fname = $('#fname').val();
    const mname = $('#mname').val();
    const lname = $('#lname').val();
    const dob = $('#dob').val();
    const pob = $('#pob').val();
    const cs = $('#cs').val();
    const email = $('#email').val();
    const contact = $('#contact').val();
    const position = $('#position').val();
    const brgy = $('#brgy').val();
    const otitle = $('#otitle').val();

    const errors = [];

    // First Name
    if (!fname) {
        errors.push('First name is required');
    } else if (fname.length < 2) {
        errors.push('First name must be at least 2 characters');
    } else if (fname.length > 50) {
        errors.push('First name must be less than 50 characters');
    } else if (!/^[a-zA-Z\s\-']+$/.test(fname)) {
        errors.push('First name can only contain letters, spaces, hyphens, and apostrophes');
    }

    // Middle Name (optional)
    if (mname && !/^[a-zA-Z\s\-']+$/.test(mname)) {
        errors.push('Middle name can only contain letters, spaces, hyphens, and apostrophes');
    }

    // Last Name
    if (!lname) {
        errors.push('Last name is required');
    } else if (lname.length < 2) {
        errors.push('Last name must be at least 2 characters');
    } else if (lname.length > 50) {
        errors.push('Last name must be less than 50 characters');
    } else if (!/^[a-zA-Z\s\-']+$/.test(lname)) {
        errors.push('Last name can only contain letters, spaces, hyphens, and apostrophes');
    }

    // Date of Birth
    if (!dob) {
        errors.push('Date of birth is required');
    } else {
        const birthDate = new Date(dob);
        const today = new Date();
        const age = today.getFullYear() - birthDate.getFullYear();
        if (birthDate > today) {
            errors.push('Date of birth cannot be in the future');
        }
        if (age > 120) {
            errors.push('Please enter a valid date of birth');
        }
    }

    // Place of Birth
    if (!pob) {
        errors.push('Place of birth is required');
    } else if (pob.length > 100) {
        errors.push('Place of birth must be less than 100 characters');
    } else if (!/^[a-zA-Z\s\-',.]+$/.test(pob)) {
        errors.push('Place of birth contains invalid characters');
    }

    // Civil Status
    if (!cs) {
        errors.push('Civil status is required');
    }

    // Email
    if (!email) {
        errors.push('Email is required');
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        errors.push('Please enter a valid email address');
    }

    // Contact Number
    if (!contact) {
        errors.push('Contact number is required');
    } else if (!/^09\d{9}$/.test(contact)) {
        errors.push('Contact number must be 11 digits starting with 09');
    }

    // Position
    if (!position) {
        errors.push('Position is required');
    }

    // Barangay
    if (!brgy) {
        errors.push('Barangay is required');
    }

    // Title (optional)
    if (otitle && otitle.length > 50) {
        errors.push('Title must be less than 50 characters');
    }

    // Show errors if any
    if (errors.length > 0) {
        alert(errors.join('\n'));
        return;
    }
    console.log(fname,
        mname,
        lname,
        dob,
        pob,
        cs,
        email,
        contact,
        position,
        brgy,
        otitle)
    $.ajax({
        url: '../../data/admin-add-officials.php',
        type: 'POST',
        data: {
            addOfficial: true,
            fname: fname,
            mname: mname,
            lname: lname,
            dob: dob,
            pob: pob,
            cs: cs,
            email: email,
            contact: contact,
            position: position,
            brgy: brgy,
            otitle: otitle
        },
        success: function (response) {
            console.log(response);
            if (response.success) {
                alert(response.success);
            }
        },
        error: function (xhr, status, error) {
            alert(error);
        },
    });
}




