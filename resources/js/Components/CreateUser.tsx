import React, { useState } from "react";
import axios from 'axios';

interface UserField {
    name: string;
    email: string;
    password: string;
    role: string; // Add role field
}

const CreateUser: React.FC = () => {
    const [userField, setUserField] = useState<UserField>({
        name: "",
        email: "",
        password: "",
        role: "student" // Set default role
    });

    const changeUserFieldHandler = (e: React.ChangeEvent<HTMLInputElement>) => {
        setUserField({
            ...userField,
            [e.target.name]: e.target.value
        });
    }

    const onSubmitChange = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        try {
            const response = await axios.post("/api/addnew", userField);
            console.log(response.data);
            // Optionally, you can redirect the user or perform other actions after successful creation
        } catch (err) {
            console.log("Something Wrong");
        }
    }

    return (
        <div className="max-w-md mx-auto mt-5">
            <h1 className="text-2xl text-center mb-2">Add New User</h1>
            <div>
                <form onSubmit={onSubmitChange}>
                    <div className="mb-5">
                        <label htmlFor="name" className="block text-sm font-medium text-gray-900">
                            Full Name
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            className="input input-bordered input-primary w-full max-w-xs"
                            placeholder="Full Name..."
                            value={userField.name}
                            onChange={changeUserFieldHandler}
                        />
                    </div>
                    <div className="mb-5">
                        <label htmlFor="email" className="block text-sm font-medium text-gray-900">
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            className="input input-bordered input-primary w-full max-w-xs"
                            placeholder="Email..."
                            value={userField.email}
                            onChange={changeUserFieldHandler}
                        />
                    </div>

                    <div className="mb-5">
                        <label htmlFor="password" className="block text-sm font-medium text-gray-900">
                            Password
                        </label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            className="input input-bordered input-primary w-full max-w-xs"
                            placeholder="Password..."
                            value={userField.password}
                            onChange={changeUserFieldHandler}
                        />
                    </div>

                    <div className="mb-5">
                        <label htmlFor="role" className="block text-sm font-medium text-gray-900">
                            Role
                        </label>
                        <select
                            name="role"
                            id="role"
                            className="input input-bordered input-primary w-full max-w-xs"
                            value={userField.role}
                            onChange={changeUserFieldHandler}
                        >
                            <option value="superadmin">Superadmin</option>
                            <option value="admin">Admin</option>
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>

                    <button type="submit" className="btn btn-primary">Add User</button>
                </form>
            </div>
        </div>
    );
};

export default CreateUser;
